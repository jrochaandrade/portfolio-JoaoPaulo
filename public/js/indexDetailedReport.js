


window.deleteData = function(report_ID) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF0000',
        cancelButtonColor: '#007bff',
        cancelButtonText: 'Cancelar',
        confirmButtonText:'Sim, exclua!'
    }).then((result) => {
        if(result.value) {
            var form = $('<form>', {
                'method': 'POST',
                'action': '/report/' + report_ID,
            });
            var hiddenInput = $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': 'DELETE',
            });
            var hiddenToken = $('<input>', {
                'name': '_token',
                'type': 'hidden',
                'value': jQuery('meta[name="csrf-token"]').attr('content'),
            });
            Swal.fire({
                title: 'Embargo excluido!',
                text: 'Aguarde a página ser recarregada.',
                icon: 'success',
                confirmButtonColor: '',
                confirmButtonText: 'OK',
            }).then((result) => {
                form.append(hiddenInput).append(hiddenToken).appendTo('body').submit()
            }
            )
        }
    })
}



