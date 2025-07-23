$(document).ready(function () {
    // Order button click handler
    $('.btn-order').click(function () {
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: `/user/items/sizes-prices/${id}`,
            success: function (response) {
                // Update form action
                $('#OrderForm').attr('action', `/user/create-order/${id}`);

                console.log(response);

                // Handle custom vs standard products
                if (response.is_custom) {
                    // Show custom size section
                    $('#standardSizeSection').hide();
                    $('#customSizeSection').show();

                    // Set price per cm²
                    $('#pricePerSize').val('Rp ' + parseFloat(response.price_per_size).toLocaleString('id-ID'));

                    // Clear and focus custom size input
                    $('#customSize').val('').focus();
                    $('#customTotalPrice').val('');
                } else {
                    // Show standard size section
                    $('#standardSizeSection').show();
                    $('#customSizeSection').hide();

                    // Populate size options
                    if (response.sizes && response.sizes.length > 0) {
                        var sizeOptionsHtml = response.sizes.map((size, i) => `
                            <div class="col-md-2 col-6 mb-2">
                                <input type="radio" name="size" value="${size}" data-price="${response.prices[i]}" id="size-${i}" class="btn-check">
                                <label for="size-${i}" class="btn btn-outline-primary w-100 p-3 fw-bold">
                                    ${size} <br>
                                    <small class="text-muted">Rp ${parseFloat(response.prices[i]).toLocaleString('id-ID')}</small>
                                </label>
                            </div>
                        `).join('');

                        $('#sizeOptionsContainer').html(`<div class="row g-2">${sizeOptionsHtml}</div>`);

                        // Event listener for price update
                        $('input[name="size"]').on('change', function () {
                            var price = $(this).data('price');
                            $('#hiddenPrice').val(price);
                        });

                        // Add hidden input for price if not exists
                        if ($('#hiddenPrice').length === 0) {
                            $('#sizeOptionsContainer').append('<input type="hidden" id="hiddenPrice" name="price">');
                        }
                    } else {
                        $('#sizeOptionsContainer').html('<p class="text-danger">Ukuran tidak tersedia.</p>');
                    }
                }

                // Show modal
                $('#orderModal').modal('show');
            }
        });
    });

    // Event listener
    $('#customSize, #Qty').on('input', calculateCustomPrice);

    function calculateCustomPrice() {
        const sizeRaw = $('#customSize').val().trim().toLowerCase();
        const pricePerCm2 = parseInt($('#pricePerSize').val().replace(/[^\d]/g, '')) || 0;
        const qty = parseInt($('#Qty').val()) || 1;

        const dimensions = sizeRaw.split(/[x×]/);
        if (dimensions.length === 2) {
            const width = parseFloat(dimensions[0]);
            const height = parseFloat(dimensions[1]);

            if (!isNaN(width) && !isNaN(height) && pricePerCm2 > 0 && qty > 0) {
                const area = width * height;
                const totalPrice = area * pricePerCm2 * qty;
                const totalPriceWithoutQty = area * pricePerCm2;

                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(totalPrice);

                $('#customTotalPrice').val(formatted);

                $('#priceRaw').val(totalPrice);

                $('#price').val(totalPriceWithoutQty);

                return;
            }
        }

        $('#customTotalPrice').val('');
    }

    // Toggle antara upload file dan URL
    $('input[name="uploadOption"]').on('change', function () {
        if ($('#uploadFile').is(':checked')) {
            $('#fileInputSection').show();
            $('#urlInputSection').hide();
        } else if ($('#useLink').is(':checked')) {
            $('#fileInputSection').hide();
            $('#urlInputSection').show();
        }
    });
});
