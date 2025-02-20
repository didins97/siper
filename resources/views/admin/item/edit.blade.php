<div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="EditForm">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="Editname" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="Editdescription" rows="3" name="desc"></textarea>
                    </div>
                    <div id="EditdynamicForm">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="Editsize">Ukuran</label>
                                <input type="text" class="form-control" id="Editsize" name="sizes[]">
                            </div>
                            <div class="form-group col">
                                <label for="Editprice">Harga</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" id="Editprice" name="prices[]">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btn-multiple-edit"><i
                                                class="fas fa-plus"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h6>Panduan Tambah Ukuran & Harga</h6>
                        <ol>
                            <li>Ukuran di isi dengan format text <b>cth : 30 x 40</b></li>
                            <li>Harga di isi dengan angka</li>
                        </ol>
                    </div>
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="uploadThumbnail" class="form-label">Thumbnail</label>
                            <input name="image" class="form-control" id="uploadThumbnail" type="file"
                                data-edit-preview=".edit-preview" accept="image/png, image/jpeg">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                @if ($item->image == 'noimage.jpg')
                                    <img class="edit-preview mb-3 text-center"
                                        src="{{ asset('assets/img/noimage.jpg') }}" width="50%" />
                                @else
                                    <img class="edit-preview mb-3 text-center"
                                        src="{{ asset('storage/images/products/' . $item->image) }}" width="50%" />
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Panduan unggah gambar</h6>
                            <ol>
                                <li>Resolusi gambar yang di unggah, <b>1280 x 720</b></li>
                                <li>Ukuran gambar tidak lebih dari <b>1 Mb</b></li>
                            </ol>
                        </div>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="publishSwitch" name="is_active" checked>
                        <label class="custom-control-label" for="publishSwitch">Publish</label>
                        <small class="form-text text-muted">Jangan Centang jika belum ingin ditampilkan</small>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="unggulanSwitch" name="is_featured">
                        <label class="custom-control-label" for="unggulanSwitch">Produk Unggulan</label>
                        <small class="form-text text-muted">Centang jika produk ini akan ditampilkan di beranda.</small>
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
