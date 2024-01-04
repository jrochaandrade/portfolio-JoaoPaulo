

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


/* document.getElementById('btnPrint').addEventListener('click', imprimirDiv)
function imprimirDiv(divId) {
    var conteudo = document.getElementById('main').innerHTML; // obter o conteúdo da div
    var novaJanela = window.open('', 'Janela de Impressão', 'height=600,width=800'); // abrir uma nova janela
    novaJanela.document.write('<html><head>'); // escrever o cabeçalho da nova janela
    novaJanela.document.write('<style> *{ padding: 0px; margin: 0px; font-size: 15px; font-family: Arial, lvetica, sans-serif;} .p {text-align: justify; line-height: 1.5;} .content { display: flex; justify-content: center; flex-direction: column; align-items: center;}.main {width: 800px; background-color: white; color: black; padding: 31px; height: 100%;} .header { height: 138px; padding: 5px; margin-bottom: 30px; } .logos { display: flex; justify-content: space-between; width: 100%;   padding: 10px 20px; height: 117px; } .logos span { font-size: 15px; font-weight: 600; text-align: center;} .logos .logo1 { height: 80px;  width: 167px;} .logos .logo2 { height: 72px; width: 70px; } .logos .logo3 {  height: 72px; width: 70px; } .titleBody { display: flex;  flex-direction: column;  align-items: center; margin-bottom: 20px;  } .titleBody p { margin-bottom: 5px;} .divDocs { margin-bottom: 20px;} .divDocs p { margin-bottom: 5px; } .dataOffender {  display: flex; justify-content: center;  margin-bottom: 20px;} .tableDataOffender { font-size: 5px; width: 700px;  } .tableDataOffender th, .tableDataOffender td {  padding: 1px;  height: 5px;} .cell{ width: 168px;} .titles {  font-size: 16px; font-weight: 600;  margin-bottom: 4px;} .titles2 { font-size: 15px;  font-weight: 600; text-indent: 1rem; margin-top: 20px; margin-bottom: 3px;} .historic {  white-space: pre-line; text-align: justify; } .historic .indent { text-indent: 3em; margin-bottom: 0px;} .images { display: flex; justify-content: center; flex-direction: column; align-items: center; margin-top: 20px;} .images img { width: 500px; height: 290px; margin-bottom: 10px;  border: 1px solid black;} .reasons { margin-top: 30px;} .team { display: flex; justify-content: center; margin-top: 60px; margin-bottom: 50px;} .tableTeam { font-size: 5px; width: 100%; margin-bottom: 80px; } .tableTeam th, .tableTeam td { padding: 1px; white-space: nowrap; padding: 0px 10px 0px 10px; } .signature { display: flex;  justify-content: center; text-align: center; flex-direction: column; align-items: center;} .signature p { margin: 0px; } .pIndent { text-indent: 3em;} .divBtn { display: flex; flex-direction: row;} .divBtn .btnPrint { margin-right: 5px;} .divBtn .btnCreatePDF {   margin-right: 5px;} .article { font-size: 12px; margin-left: 30px;} .criminal {  margin-top: 47px;}</style>'); // escrever o estilo da nova janela
    novaJanela.document.write('</head><body>'); // escrever o corpo da nova janela
    novaJanela.document.write(conteudo); // escrever o conteúdo da div na nova janela
    novaJanela.document.write('</body></html>'); // escrever o fechamento da nova janela
    novaJanela.document.close(); // fechar o documento da nova janela
    novaJanela.print(); // imprimir a nova janela
  } */



 