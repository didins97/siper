<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Change Order Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="statusForm" action="{{ route('admin.orders.update.status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Pilih Status:</label>
                        <select class="form-control" id="status" name="status" onchange="togglePriority()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            <option value="inprogress" {{ $order->status == 'inprogress' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </div>

                    {{-- <div class="form-group">
                        <label for="dateExpect">Perkiraan Waktu Selesai</label>
                        <input type="date" class="form-control" id="dateExpect" name="expected_date" value="{{ $order->expected_date }}">
                    </div>

                    <!-- Priority -->
                    <div class="form-group" id="prioritySection" style="display: none;">
                        <label class="mb-2 fw-bold">Priority:</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="primary" name="priority" value="primary"
                                    {{ $order->priority == 'primary' ? 'checked' : '' }}>
                                <label class="form-check-label btn btn-outline-primary" for="primary">Primary</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="secondary" name="priority" value="secondary"
                                    {{ $order->priority == 'secondary' ? 'checked' : '' }}>
                                <label class="form-check-label btn btn-outline-warning" for="secondary">Secondary</label>
                            </div>
                        </div>
                    </div> --}}
                    <div id="additionalFields"></div>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
