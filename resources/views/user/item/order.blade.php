<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="OrderForm">
                @csrf
                <div class="modal-body">
                    <input type="number" id="priceRaw" name="total_amount" hidden>
                    <input type="number" id="price" name="price" hidden>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Atas Nama</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="price">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">No Hp</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                    <!-- Standard Size Options -->
                    <div id="standardSizeSection">
                        <div class="form-group">
                            <label for="sizeOption">Pilih ukuran:</label>
                            <div id="sizeOptionsContainer"></div>
                        </div>
                    </div>

                    <!-- Custom Size Input -->
                    <div id="customSizeSection" style="display: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customSize">Ukuran Custom (cm)</label>
                                    <input type="text" class="form-control" id="customSize" name="custom_size" placeholder="Contoh: 30x40">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga per cm²</label>
                                    <input type="text" class="form-control" id="pricePerSize" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total Harga</label>
                            <input type="text" class="form-control" id="customTotalPrice" name="custom_price" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="Qty">Jumlah</label>
                                <input type="number" class="form-control" id="Qty" name="qty" min="1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="dateExpect">Perkiraan Waktu Selesai</label>
                                <input type="date" class="form-control" id="dateExpect" name="expected_date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">Catatan</label>
                        <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imageOption">Pilih cara memasukkan gambar:</label>
                        <div>
                            <input type="radio" id="uploadFile" name="imageOption" value="upload" checked>
                            <label for="uploadFile">Unggah dari komputer</label>
                        </div>
                        <div>
                            <input type="radio" id="useLink" name="imageOption" value="link">
                            <label for="useLink">Gunakan URL</label>
                        </div>
                    </div>
                    <div class="form-group" id="fileInputSection">
                        <label for="image">Unggah Gambar:</label>
                        <input type="file" class="form-control-file" id="image" name="path_file">
                    </div>
                    <div class="form-group" id="urlInputSection" style="display: none;">
                        <label for="imageUrl">URL Gambar:</label>
                        <input type="text" class="form-control" id="imageUrl" name="url_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
$(document).ready(function() {
    // Toggle between file upload and URL input
    $('input[name="imageOption"]').change(function() {
        if ($(this).val() === 'upload') {
            $('#fileInputSection').show();
            $('#urlInputSection').hide();
        } else {
            $('#fileInputSection').hide();
            $('#urlInputSection').show();
        }
    });
});
</script> --}}
