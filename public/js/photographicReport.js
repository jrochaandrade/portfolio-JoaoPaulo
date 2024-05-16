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