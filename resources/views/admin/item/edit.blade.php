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
                        <label for="Editname">Nama</label>
                        <input type="text" class="form-control" id="Editname" name="name">
                    </div>
                    <div class="form-group">
                        <label for="Editdescription">Deskripsi</label>
                        <textarea class="form-control" id="Editdescription" rows="3" name="desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Editcategory">Kategori</label>
                        <select class="form-control" id="Editcategory" name="category_id" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Custom Size Toggle -->
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input" id="EditIsCustom" name="is_custom">
                        <label class="custom-control-label" for="EditIsCustom">Ukuran Custom</label>
                        <small class="form-text text-muted">Centang jika produk memiliki ukuran custom</small>
                    </div>

                    <!-- Standard Size & Price (Hidden when custom is checked) -->
                    <div id="EditStandardSizeForm">
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
                    </div>

                    <!-- Custom Price per Size (Shown when custom is checked) -->
                    <div id="EditCustomSizeForm" style="display: none;">
                        <div class="form-group">
                            <label for="EditPricePerSize">Harga per cm<sup>2</sup></label>
                            <input type="number" class="form-control" id="EditPricePerSize" name="price_per_size" placeholder="Masukkan harga per cm persegi">
                        </div>
                        <div class="mb-3">
                            <h6>Panduan Harga Custom</h6>
                            <ol>
                                <li>Harga akan dihitung berdasarkan luas (panjang x lebar) dikali harga per cm<sup>2</sup></li>
                                <li>Contoh: Ukuran 30x40cm dengan harga Rp100 = 30x40x100 = Rp120.000</li>
                            </ol>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="mb-4">
                            <label for="editUploadThumbnail" class="form-label">Thumbnail</label>
                            <input name="image" class="form-control" id="editUploadThumbnail" type="file"
                                data-edit-preview=".edit-preview" accept="image/png, image/jpeg">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <img class="edit-preview mb-3 text-center" src="{{ asset('assets/img/noimage.jpg') }}" width="50%" />
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
                        <input type="checkbox" class="custom-control-input" id="publishSwitch" name="is_active">
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
