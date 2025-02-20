$('#status').change(function() {
    var selectedStatus = $(this).val();
    var additionalFields = $('#additionalFields');
    additionalFields.empty(); // Clear any existing additional fields

    if (selectedStatus === 'inprogress') {
        var dateField = '<div class="form-group">' +
            '<label for="expected_date">Perkiraan Selesai:</label>' +
            '<input type="date" class="form-control" id="expected_date" name="expected_date" value="{{ $order->expected_date }}" required>' +
            '</div>';
        var priorityField = '<div class="form-group">' +
            '<label for="priority">Prioritas:</label>' +
            '<select class="form-control" id="priority" name="priority" required>' +
            '<option value="secondary">Low (Normal)</option>' +
            '<option value="primary">High (Urgent)</option>' +
            '</select>' +
            '</div>';
        additionalFields.append(dateField + priorityField);
    }
});

// Trigger change event to check the initial status value and add fields if needed
$('#status').trigger('change');
