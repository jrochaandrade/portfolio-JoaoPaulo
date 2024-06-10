/* document.getElementById('photos').addEventListener('change', function () {
    this.closest('form').submit()
}) */

$(document).ready(function () {
    $('[data-toggle="modal"]').click(function () {
        $($(this).data('target')).modal('show');
    });
});

document.getElementById('btnSubmit').addEventListener('click', () => {
    // Mostrar feeedback de carregamento
    document.getElementById('loader').style.display = 'block';
});
