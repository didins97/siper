$('.delete').click(function(e) {
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
                url: `/admin/orders/${id}`,
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
