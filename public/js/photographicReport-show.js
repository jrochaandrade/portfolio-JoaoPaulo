$(document).ready(function() {
    $('.btnPrint').click(function() {
        const pages = document.querySelectorAll('.borderPage');
        
        // Ocultar as bordas das páginas
        pages.forEach(page => {
            page.style.border = 'none';
        });

        // Imprimir a página usando a função `printThis`
        $('#report').printThis({
            afterPrint: function() {
                // Restaurar as bordas após a impressão
                pages.forEach(page => {
                    page.style.border = '1px solid black';
                });
            }
        });
    });
});

// Botão para gerar PDF
$('.btnPdf').click(function() {
    generatePdf();
});

async function generatePdf() {

    // Mostrar feeedback de carregamento
    document.getElementById('loader').style.display = 'block';

    const pages = document.querySelectorAll('.borderPage');
    if (pages.length === 0) {
        console.error('Nenhuma página encontrada para gerar PDF.');
        document.getElementById('loader').style.display = 'none';
        return;
    }

    // Configurações do jsPDF
    const pdf = new jsPDF('p', 'mm', 'a4');
    const options = {
        scale: 2,
        useCORS: true,
    };

    for (let i = 0; i < pages.length; i++) {
        const page = pages[i];
        const canvas = await html2canvas(page, options);
        const imgData = canvas.toDataURL('image/jpeg', 0.98);
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        if (i > 0) {
            pdf.addPage();
        }
        pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
    }

    pdf.save('Relatório Fotográfico.pdf');
    document.getElementById('loader').style.display = 'none';
}


/* Inicio do script para enviar formulário de exclusão e mostar mensagem */
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
                title: 'Relatório excluido!',
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

