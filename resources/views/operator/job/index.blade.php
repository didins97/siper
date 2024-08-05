@extends('app')

@section('css')
    <style>
        .job-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .priority-icon {
            float: right;
            font-size: 1.2em;
        }

        .delete-zone {
            min-height: 100px;
            background-color: #f8d7da;
            border: 2px dashed #f5c6cb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            color: #721c24;
        }
    </style>
@endsection

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Management Job</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">To Do (Belum Dikerjakan)</h6>
                </div>
                <div class="card-body sortable job-list" id="pending">
                    @foreach ($pendingJobs as $item)
                        <div class="card mb-2" data-id="{{ $item->id }}">
                            <div class="card-body job-card">
                                <p class="card-text"><b>{{ $item->order->order_number }}</b> - {{ $item->order->name }}<i
                                        class="fas fa-arrow-{{ $item->priority == 'primary' ? 'up text-danger' : 'right text-warning' }} priority-icon"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-secondary text-white">
                    <h6 class="m-0 font-weight-bold">In Progress (Sedang Dikerjakan)</h6>
                </div>
                <div class="card-body sortable job-list" id="processing">
                    @foreach ($inProgressJobs as $item)
                        <div class="card mb-2" data-id="{{ $item->id }}">
                            <div class="card-body job-card">
                                <p class="card-text"><b>{{ $item->order->order_number }}</b> - {{ $item->order->name }}<i
                                        class="fas fa-arrow-{{ $item->priority == 'primary' ? 'up text-danger' : 'right text-warning' }} priority-icon"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Done (Selesai)</h6>
                </div>
                <div class="card-body sortable job-list" id="completed">
                    @foreach ($completedJobs as $item)
                        <div class="card mb-2" data-id="{{ $item->id }}">
                            <div class="card-body job-card">
                                <p class="card-text"><b>{{ $item->order->order_number }}</b> - {{ $item->order->name }}<i
                                        class="fas fa-arrow-{{ $item->priority == 'primary' ? 'up text-danger' : 'right text-warning' }} priority-icon"></i>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Zone -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="delete-zone" id="delete-zone">
                <i class="fas fa-trash-alt"></i> Drag dan drop item di sini untuk menghapus
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('operator.job.show')
@endsection

@push('scripts')
    <!-- Include Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Include Sortable.js -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Sortable.js pada setiap div dengan class sortable
            const containers = document.querySelectorAll('.sortable');
            containers.forEach(container => {
                new Sortable(container, {
                    group: 'shared',
                    animation: 150,
                    onEnd: function(evt) {
                        const itemEl = evt.item;
                        console.log('Moved item', itemEl);
                        console.log('From', evt.from.id);
                        console.log('To', evt.to.id);
                        console.log('New index:', evt.newIndex);

                        var id = itemEl.dataset.id;

                        if (evt.to.id === 'delete-zone') {
                            $.ajax({
                                type: "DELETE",
                                url: `/operator/jobs/${id}`,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log('response : ' + response);
                                    itemEl.remove();
                                }
                            });
                        } else {
                            $.ajax({
                                type: "PUT",
                                url: `/operator/jobs/status/${id}`,
                                data: {
                                    status: evt.to.id,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log('response : ' + response);
                                }
                            });
                        }
                    },
                });
            });

            document.querySelectorAll('.job-card').forEach(card => {
                card.addEventListener('click', function() {
                    var id = card.parentElement.dataset.id;

                    $.ajax({
                        type: "GET",
                        url: `/admin/jobs/${id}`,
                        success: function(response) {
                            var status;

                            switch (response.status) {
                                case 'pending':
                                    status = 'Belum Di Kerjakan';
                                    break;
                                case 'processing':
                                    status = 'Sedang Di Kerjakan';
                                    break;
                                case 'completed':
                                    status = 'Selesai';
                                    break;
                                default:
                                    break;
                            }

                            $('#jobModalLabel').text(response.order.order_number);
                            $('#jobModalLabel').append(
                                ` <i class="fas fa-arrow-${response.priority == 'primary' ? 'up text-danger' : 'right text-warning'} priority-icon"></i>`
                                );

                            $('#jobDetailsList').empty();

                            var details = `
                                <li class="list-group-item"><strong>Nama Pemesan :</strong> ${response.order.name}</li>
                                <li class="list-group-item"><strong>Ukuran :</strong> ${response.order.size}</li>
                                <li class="list-group-item"><strong>Jumlah :</strong> ${response.order.qty}</li>
                                <li class="list-group-item"><strong>Tgl. Pengambilan:</strong> ${response.order.expected_date}</li>
                                <li class="list-group-item"><strong>Catatan :</strong> ${response.order.notes}</li>
                                <li class="list-group-item"><strong>Status :</strong> ${status}</li>
                            `;

                            $('#jobDetailsList').append(details);

                            $('#jobModal').modal('show');
                        }
                    });
                });
            });

            new Sortable(document.getElementById('delete-zone'), {
                group: 'shared',
                onAdd: function(evt) {
                    const itemEl = evt.item;
                    var id = itemEl.dataset.id;

                    $.ajax({
                        type: "DELETE",
                        url: `/admin/jobs/${id}`,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log('response : ' + response);
                            itemEl.remove();
                        }
                    });
                },
            });
        });
    </script>
@endpush
