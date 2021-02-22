$(function () {
    $(document).on('click', '.modal-eat ', function (e) {
        e.preventDefault();
        $('#modal-eat').modal('show').find('.modal-body').load(this.href);
    });
    $(document).on('submit', '#apple-eat', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serializeArray(),
            success: function (response) {
                console.log(response);
                $.pjax.reload({container: '#p0'});
                $('#modal-eat').modal('hide');
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Bitten off',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            error: function (response) {
                $('#modal-eat').modal('hide');
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: response.responseJSON.message
                })
            }
        });
    })
});
