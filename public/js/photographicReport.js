$(document).ready(function() {
    $('#btnPrint').click(function() {
        console.log('cliclou')
        $('#report').printThis() 
            
    })

    /* $('#btnPrint').click(function() {
        console.log(`clicou`)
        html2canvas(document.querySelector('#main')).then((canvas) => {
            let base64image = canvas.toDataURL('image/png')
            
            window.jsPDF = window.jspdf.jsPDF;

            let pdf = new jsPDF('p', 'px', [1600, 1131])
            pdf.addImage(base64image, 'PNG', 15, 15, 1110, 360)
            pdf.save('teste.pdf')

        })
    }) */
})

document.getElementById('btnBack').addEventListener('click', () => {
    window.history.back();
    
})


// Espera até que a página esteja completamente carregada
window.addEventListener('load', function() {
    const btnPdf = document.getElementById('btnPdf');
    btnPdf.addEventListener('click', generatePdf);
});

async function generatePdf() {
    const pages = document.querySelectorAll('.borderPage');
    if (pages.length === 0) {
        console.error('Nenhuma página encontrada para gerar PDF.');
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
}


