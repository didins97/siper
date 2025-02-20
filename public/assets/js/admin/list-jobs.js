$(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
        title: 'Apa anda yakin untuk menghapus ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6777ef',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: `/admin/jobs/${id}`,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(results) {
                    if (results.success === true) {
                        Swal.fire("Done!", results.message, "success");
                        location.reload();
                    } else {
                        Swal.fire("Error!", results.message, "error");
                    }
                }
            });
        }
    })
})

$(document).on('click', '.edit', function(e) {
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: "/admin/jobs/" + id,
        success: function (response) {
            console.log(response);

            $('#status').val(response.status);
            $('#startDate').val(response.start_date);
            $('#endDate').val(response.end_date);
            $('#statusForm').attr('action', `/admin/jobs/${response.id}`);

            $('#statusModal').modal('show');
        }
    });
})
