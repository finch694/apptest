$(document).ready(function () {
    $('.grid-view tbody .modal-eat ').on('click', function (e) {
        e.preventDefault();
        $('#modal-eat').modal('show');
        $('#modal-eat').find('.modal-body').load(this.href);
    });
});
