$(document).ready(function() {
    /* // Botão para voltar à página anterior
    $('.btnBack').click(function() {
        window.history.back();
    }); */

    // Botão para excluir foto com confirmação
    $(document).on('click', '.btnDelete', function(e) {
        e.preventDefault();
        const photoId = $(this).data('photo-id');
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FF0000',
            cancelButtonColor: '#007bff',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, exclua!'
        }).then((result) => {
            if (result.isConfirmed) {
                deletePhoto(photoId, $(this));
            }
        });
    });

    // Função para excluir foto
    function deletePhoto(photoId, element) {
        // Remove a foto da interface
        element.closest('div.photo').remove();

        // Adiciona um input hidden ao formulário para enviar o ID da foto a ser excluída
        const input = `<input type="hidden" name="delete_photos[]" value="${photoId}">`;
        $('form').append(input);
    }
});

document.getElementById('btnGeneration').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('btnSubmit').click();
})

document.getElementById('btnSubmitClick').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('btnSubmit').click();
})

// Levar página para o topo ao clicar no botão acima
document.getElementById('scrollUp').addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
})

// Levar página para o final ao clicar no botão abaixo
document.getElementById('scrollDown').addEventListener('click', () => {
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
    })
})


