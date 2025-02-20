// preview image
function setupImagePreview(input, previewSelector) {
    var reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
    reader.onload = function(event) {
        $(previewSelector).attr('src', event.target.result);
    };
}

/* function Tambah Item */
$("input[data-preview]").change(function() {
    var input = $(this);
    var previewSelector = input.data('preview');
    setupImagePreview(input[0], previewSelector);
});

var formCounter = 0;
$(document).on('click', '.btn-multiple', function(e) {
    formCounter++;
    // console.log(formCounter);

    var objTo = document.getElementById('dynamicForm');
    var divTest = document.createElement('div');
    divTest.setAttribute('class', `form-row sipre${formCounter}`);
    divTest.innerHTML = `
        <div class="form-group col">
            <label for="size">Ukuran</label>
            <input type="text" class="form-control" id="size" name="sizes[]">
        </div>
        <div class="form-group col">
            <label for="price">Harga</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" id="price" name="prices[]">
                <span class="input-group-append">
                    <button type="button" class="btn btn-danger btn-flat btn-remove"><i class="fas fa-minus"></i></button>
                </span>
            </div>
        </div>
    `;
    objTo.appendChild(divTest);
});

$(document).on('click', '.btn-remove', function(e) {
    $(this).parents('.form-row').remove();
    formCounter--;
});

/* function Edit Item */
$("input[data-edit-preview]").change(function() {
    var input = $(this);
    var previewSelector = input.data('edit-preview');
    setupImagePreview(input[0], previewSelector);
});

var formCounterEdit = 0;
$(document).on('click', '.btn-multiple-edit', function(e) {
    formCounterEdit++;
    var objTo = document.getElementById('EditdynamicForm');
    var divTest = document.createElement('div');
    divTest.setAttribute('class', `form-row sipre-edit${formCounterEdit}`);
    divTest.innerHTML = `
        <div class="form-group col">
            <label for="size">Ukuran</label>
            <input type="text" class="form-control" id="size" name="sizes[]">
        </div>
        <div class="form-group col">
            <label for="price">Harga</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" id="price" name="prices[]">
                <span class="input-group-append">
                    <button type="button" class="btn btn-danger btn-flat btn-remove-edit"><i class="fas fa-minus"></i></button>
                </span>
            </div>
        </div>
    `;
    objTo.appendChild(divTest);
});

$(document).on('click', '.btn-remove-edit', function(e) {
    $(this).parents('.form-row').remove();
    formCounterEdit--;
});

$(document).on('click', '.edit', function(e) {
    var id = $(this).data('id');
    // console.log(id);
    $.ajax({
        type: "GET",
        url: `/admin/products/${id}/edit`,
        success: function(response) {
            // console.log(response);
            $('#Editname').val(response.name);
            $('#Editprice').val(response.price);
            $('#Editstock').val(response.stock);
            $('#Editsize').val(response.size);
            $('#Editdescription').val(response.desc);
            $('#publishSwitch').prop('checked', response.is_active);
            $('#unggulanSwitch').prop('checked', response.is_featured);
            $('.edit-preview').attr('src',
                `/storage/images/products/${response.image}`);
            $('#EditForm').attr('action', `/admin/products/${response.id}`);

            // Dekode JSON sizes dan prices menjadi array
            var sizesArray = JSON.parse(response.sizes);
            var pricesArray = JSON.parse(response.prices);

            $('#EditdynamicForm').empty();

            for (var i = 0; i < sizesArray.length; i++) {
                var size = sizesArray[i];
                var price = pricesArray[i];

                // Menambahkan form dinamis dengan data ukuran dan harga
                var dynamicFormHtml = `
                    <div class="form-row ${ i > 0 ? 'sipre-edit' + i : '' }">
                        <div class="form-group col">
                            <label for="size">Ukuran</label>
                            <input type="text" class="form-control" id="size" name="sizes[]" value="${size}">
                        </div>
                        <div class="form-group col">
                            <label for="price">Harga</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="price" name="prices[]" value="${price}">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-${i > 0 ? 'danger btn-remove-edit' : 'success btn-multiple-edit'} btn-flat"><i class="fas ${i > 0 ? 'fa-minus' : 'fa-plus'}"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                `;
                $('#EditdynamicForm').append(dynamicFormHtml);

                formCounterEdit = i + 1;
            }

        }
    });
    $('#editItem').modal('show');
})
