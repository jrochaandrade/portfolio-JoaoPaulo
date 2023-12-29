

/* document.getElementById('btnPdf').addEventListener('click', () => {
    const main = document.getElementById('main').outerHTML

    const newTab = window.open('', '_black')

    newTab.document.write('<html><head><title>Relatório Circunstanciado</title></head><body>')
    newTab.document.write(main)
    newTab.document.write('</body></html>')

    newTab.document.close()
}) */

// Obtem o botão gerar pdf
/* const btnPdf = document.getElementById('btnPdf');
btnPdf.addEventListener('click', generatePdf);
// Função para gerar o pdf
function generatePdf() {    
    const main = document.getElementById('main');
    
    
    html2pdf(main, {
        margin: [0, 0, 0, 0],
        filename: 'Relatório Fotográfico.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait',
            border: '1px solid #000',
        },
    });
} */

/* const btnPdf = document.getElementById('btnPdf');
btnPdf.addEventListener('click', generatePdf);


function generatePdf() {
    const page = document.getElementById('main')
    var opt = {
        margin:       1,
        filename:     'Demopdf.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 1 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    // Choose the element that our invoice is rendered in.
    html2pdf().set(opt).from(page).save();
    } */

/* const btnPdf = document.getElementById('btnPdf');
    btnPdf.addEventListener('click', generatePdf);
    // Função para gerar o pdf
    function generatePdf() {    
        const page = document.getElementById('main');
        
        
        html2pdf(page, {
            margin: 0,
            filename: 'Relatório Fotográfico.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait',
                border: '1px solid #000',
            },
            pagebreak: { mode: 'avoid-all' },
        });
} */
$(document).ready(function() {
    $('#btnPrint').click(function() {
        $('#main').printThis()       
    })

    $('#btnPdf').click(function() {

        html2canvas(document.querySelector('#main')).then((canvas) => {
            let base64image = canvas.toDataURL('image/png')
            
            window.jsPDF = window.jspdf.jsPDF;

            let pdf = new jsPDF('p', 'px', [1600, 1131])
            pdf.addImage(base64image, 'PNG', 15, 15, 1110, 360)
            pdf.save('teste.pdf')

        })
    })
})

document.getElementById('btnBack').addEventListener('click', () => {
    console.log('clicou')
    window.history.back();
    
})



 