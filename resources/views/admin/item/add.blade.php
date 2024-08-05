<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" rows="3" name="desc"></textarea>
                    </div>
                    <div id="dynamicForm">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="size">Ukuran</label>
                                <input type="text" class="form-control" id="size" name="sizes[]">
                            </div>
                            <div class="form-group col">
                                <label for="price">Harga</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" id="price" name="prices[]">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btn-multiple"><i
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
                            <input required name="image" class="form-control" id="uploadThumbnail" type="file"
                                data-preview=".preview" accept="image/png, image/jpeg">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <img class="preview mb-3 text-center" src="{{ asset('assets/img/noimage.jpg') }}"
                                    width="50%" />
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
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_active" checked>
                        <label class="custom-control-label" for="customSwitch1">Tampilkan Item</label>
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
