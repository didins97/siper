$('#cancel').on('click', function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan membatalkan pemesanan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, batalkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('user.orders.cancel', ':id') }}".replace(':id', id),
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success === true) {
                        Swal.fire("Done!", response.message, "success");
                        location.reload();
                    } else {
                        Swal.fire("Error!", response.message, "error");
                    }
                }
            });
        }
    })
})
