$(document).ready(function() {
    $('.btn-order').click(function() {
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: `/admin/choose-items/sizes-prices/${id}`,
            success: function(response) {
                if (response.sizes && response.sizes.length > 0) {
                    var sizeOptionsHtml = response.sizes.map((size, i) => `
                        <div class="col-md-2 col-6">
                            <input type="radio" name="size" value="${size}" data-price="${response.prices[i]}" id="size-${i}" class="btn-check">
                            <label for="size-${i}" class="btn btn-outline-primary w-100 p-3 fw-bold">
                                ${size} <br>
                                <small class="text-muted">Rp. ${response.prices[i]}</small>
                            </label>
                        </div>
                    `).join('');

                    $('#sizeOptionsContainer').html(`<div class="row g-2">${sizeOptionsHtml}</div>`);

                    // Event listener untuk update harga berdasarkan pilihan
                    $('input[name="size"]').on('change', function() {
                        var price = $(this).data('price');
                        $('#price').val(price);
                        $('#hiddenPrice').val(price); // Update hidden input price
                        console.log(price);
                    });

                    // Tambahkan input hidden untuk price jika belum ada
                    if ($('#hiddenPrice').length === 0) {
                        $('#sizeOptionsContainer').append('<input type="hidden" id="hiddenPrice" name="price">');
                    }
                } else {
                    $('#sizeOptionsContainer').html('<p class="text-danger">Ukuran tidak tersedia.</p>');
                }
            }
        });

        // Update form action berdasarkan ID produk
        if (id) {
            $('#OrderForm').attr('action', `/admin/create-order/${id}`);
        }

        // Tampilkan modal
        $('#orderModal').modal('show');
    });

    // Toggle antara upload file dan URL
    $('input[name="uploadOption"]').on('change', function() {
        if ($('#uploadFile').is(':checked')) {
            $('#fileInputSection').show();
            $('#urlInputSection').hide();
        } else if ($('#useLink').is(':checked')) {
            $('#fileInputSection').hide();
            $('#urlInputSection').show();
        }
    });
});
