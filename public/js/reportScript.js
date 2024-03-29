document.addEventListener('DOMContentLoaded', function () {
document.getElementById('fileInput').addEventListener('change', handleFileSelect);

// Verifica se o arquivo é do tipo imagem, e extrai o metadados
function handleFileSelect(event) {
    const files = event.target.files;
    const promises = [];

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (!file.type.startsWith('image/')) {
            console.warn('O arquivo selecionado não é uma imagem.');
            continue;
        }

        // Crie uma Promise para cada imagem
        const promise = new Promise((resolve, reject) => {
            EXIF.getData(file, function () {
                const date = EXIF.getTag(this, 'DateTimeOriginal');
                resolve({ date: date || 'Sem data', src: file });
            });
        });

        promises.push(promise);        
    }

    // Aguarde que todas as Promises sejam resolvidas
    Promise.all(promises)
    .then(photos => {  
            // Formatar data para o padrão reconhecido pela biblioteca
            for (let i = 0; i < photos.length; i++) {
                let dataString = photos[i].date;                
                // Substitua o espaço por um T
                let formattedDateString = dataString.replace(' ', 'T');
                // Substitua todos os dois pontos por underscores apenas antes do "T"
                formattedDateString = formattedDateString.replace(/:/g, function(match, offset, string) {
                    // Substitua os dois pontos por underscores apenas antes do "T"
                    if (offset < string.indexOf('T')) {
                        return '-';
                    } else {
                        return match;
                    }
                });
                // Crie um objeto Date com a data formatada
                let formattedDate = new Date(formattedDateString);
                photos[i].date = formattedDate;
            }            
            // Quando todas as Promises são resolvidas, ordene as imagens
            photos.sort((a, b) => new Date(a.date) - new Date(b.date));

            // Crie um array de elementos de imagem na ordem correta
            const imgElements = photos.map(photo => {
                const reader = new FileReader();
                return new Promise((resolve, reject) => {
                    reader.onload = function (e) {
                        const imgSrc = e.target.result;
                        const imgElement = document.createElement('img');
                        imgElement.src = imgSrc;
                        imgElement.className = 'photo';
                        resolve(imgElement);
                    };
                    reader.readAsDataURL(photo.src);
                });
            });     
                Promise.all(imgElements)
                .then(images => { 
                let cont = 0
                // Loop para criar divs e imagens
                for (let i = 0; i < images.length; i += 3) {
                    // Crie uma div com a classe 'pageWithBorder'
                    const pageDiv = document.createElement('div')
                    pageDiv.className = 'pageWithBorder'
                    pageDiv.setAttribute('name', 'pageWithBorder')
                    pageDiv.id = 'pageWithBorder' + [cont]

                    // Cria as div e o conteúdo do cabeçalho
                    const divLogos =  document.createElement('div')

                    const logos = document.createElement('div')
                    logos.className = 'logos'
                    // Cria logo 01 da esquerda
                    const img1 = document.createElement('img')
                    img1.className = 'logo1'
                    img1.src = '/images/logo1.png';
                    // Cria a descrição do centro do cabeçalho
                    const unit = document.getElementById('inputUnit').value
                    const title = document.createElement('p')
                    title.className = 'title'
                    title.innerHTML = 'Secretaria de Estado da Segurança, Defesa e Cidadania<br>Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental<br>' + unit + '<br><br>'
                    // Cria o logo 02 da direita
                    const img2 = document.createElement('img')
                    img2.className = 'logo2'
                    img2.src = '/images/logo2.png';
                    // Cria o logo 03 da direita
                    const img3 = document.createElement('img')
                    img3.className = 'logo3'
                    img3.src = '/images/logo3.png';

                    logos.append(img1, title, img2, img3)

                    divLogos.appendChild(logos)
                    // Recebe o valor digitado no input do titulo
                    const inputDesc = document.getElementById('inputDesc').value
                    // Cria um paragrafo para receber o texto digitado
                    const titleDoc = document.createElement('p')
                    titleDoc.className = 'description'
                    titleDoc.innerText = inputDesc

                    pageDiv.innerHTML = divLogos.innerHTML

                    pageDiv.appendChild(titleDoc);
                    // Cria uma div para receber as imagens
                    const divImages =  document.createElement('div')
                    divImages.className = 'photoContainerDynamic'

                    // Adicione 3 imagens à div
                    for (let j = 0; j < 3 && i + j < images.length; j++) {

                        const imgElement = document.createElement('img');
                        imgElement.src = images[i + j].src;
                        imgElement.className = 'photo';                        
                        divImages.appendChild(imgElement)
                        pageDiv.appendChild(divImages);
                    }

                    // Adiciona o número da página no rodapé
                    const pageCount = document.createElement('p');
                    pageCount.className = 'pageNumber';
                    pageCount.innerText = `Página ${cont + 1} de ${Math.ceil(images.length / 3)}`;
                    pageDiv.appendChild(pageCount);

                    // Adicione a div criada ao contêiner
                    document.getElementById('photoContainer').appendChild(pageDiv);
                    cont++
                }
                })
                .catch(error => {
                    console.error('Erro ao criar elementos de imagem:', error);
                });
        })
        .catch(error => {
            console.error('Erro ao obter metadados Exif:', error);
        });

        /* // Chame a função quando quiser rolar para o final da página
        scrollToBottom(); */

        setTimeout(() => {
            scrollToBottom();
        }, 5000);

        setTimeout(() => {
            scrollToTop();
        }, 6000);

        /* // Chame a função quando quiser rolar para o topo da página
        scrollToTop(); */

        messageReport()

}



function scrollToBottom() {
    
        window.scrollTo(0,document.body.scrollHeight);
    
}

/* function scrollToBottom() {
    // Obtém a posição da primeira div com a classe 'pageWithBorder'
    const firstPageWithBorder = document.getElementById('pageWithBorder0');
    const position = firstPageWithBorder.offsetTop + firstPageWithBorder.offsetHeight;

    // Rola até o fim da primeira div 'pageWithBorder'
    window.scrollTo(0, position);
} */



function scrollToTop() {
    
        window.scrollTo(0, 0);
    
}


});



// Espera até que a página esteja completamente carregada
window.addEventListener('load', function() {
    // Obtem o botão gerar pdf
    const btnPdf = document.getElementById('btnPdf');
    btnPdf.addEventListener('click', generatePdf);
});

// Função para gerar o pdf
function generatePdf() {    
    const page = document.getElementById('page');
    const pageWithBorder = document.getElementsByName('pageWithBorder');
    
    const lastDiv = pageWithBorder[pageWithBorder.length - 1];
    lastDiv.className = 'lastPageWithBorder';

    html2pdf(page, {
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
}





function messageReport() {
    Swal.fire({
        title: 'Aguarde!',
        text: 'Gerando realtório!',
        icon: 'warning',
        confirmButtonColor: '',
        confirmButtonText: 'OK'
    }); 
}








// Tentando com imprimir
/* const btnPdf = document.getElementById('btnPdf');
btnPdf.addEventListener('click', generatePdf);

// Função para gerar o PDF
function generatePdf() {    
    const page = document.getElementById('page').innerHTML
    const pageWithBorder = document.getElementsByName('pageWithBorder');
    console.log(pageWithBorder.length);
    const lastDiv = pageWithBorder[pageWithBorder.length - 1];
    console.log(lastDiv);
    
    lastDiv.className = 'lastPageWithBorder';


    let originalContent = document.body.innerHTML
    document.body.innerHTML = page
    window.print()
    document.body.innerHTML = originalContent
} */


/* const btnPdf = document.getElementById('btnPdf');
btnPdf.addEventListener('click', generatePdf);

function generatePdf() {
    window.jsPDF = window.jspdf.jsPDF;

    var doc = new jsPDF();

    var elementHTML = $('#photoContainer').html();

    doc.html(elementHTML, {
        callback: function (doc) {
            doc.save();
        },
        x: 10,
        y: 10,
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'letter',
            orientation: 'portrait'
        }
    });
} */




    
