<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Edit Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="statusForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="id" id="jobId"> --}}
                    <div class="form-group">
                        <label for="status">Pilih Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending">Pending (Dalam Antrian)</option>
                            <option value="completed">Completed (Selesai)</option>
                            <option value="cancelled">Cancelled (Batal)</option>
                            <option value="processing">Processing (Sedang Di Kerjakan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="endDate">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="endDate" name="end_date">
                    </div>
                    <div id="additionalFields"></div>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
