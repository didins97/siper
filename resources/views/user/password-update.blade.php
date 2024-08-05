<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.password.update', auth()->user()->id) }}" method="POST" id="PasswordForm">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Password Lama</label>
                        <input type="password" class="form-control" id="password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control" id="password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm-password" name="new_password_confirmation"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
