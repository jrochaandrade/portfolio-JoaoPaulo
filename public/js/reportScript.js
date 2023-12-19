document.getElementById('fileInput').addEventListener('change', handleFileSelect);

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
            
            for (let i = 0; i < photos.length; i++) {
                let dataString = photos[i].date;                
                
                // Substitua os dois pontos apenas na parte da hora
                let formattedDateString = dataString.replace(' ', 'T');                
                //formattedDateString = formattedDateString.replace(/:(?=\d{2}T)/g, '-')
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
            console.log(imgElements)
            
                Promise.all(imgElements)
                .then(images => { 
                let cont = 0
                // Loop para criar divs e imagens
                for (let i = 0; i < images.length; i += 3) {
                    // Crie uma div com a classe 'pageWithBorder'
                    const pageDiv = document.createElement('div');
                    pageDiv.className = 'pageWithBorder';
                    pageDiv.id = 'pageWithBorder' + [cont]

                    // Adicione o conteúdo da div 'logos' no início
                    //pageDiv.innerHTML = document.getElementById('divLogos').innerHTML;

                    const divLogos =  document.createElement('div')

                    const logos = document.createElement('div')
                    logos.className = 'logos'

                    const img1 = document.createElement('img')
                    img1.className = 'logo1'
                    img1.src = '/images/logo1.png';

                    const title = document.createElement('p')
                    title.className = 'title'
                    title.innerHTML = 'Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental'

                    const img2 = document.createElement('img')
                    img2.className = 'logo2'
                    img2.src = '/images/logo2.png';

                    logos.append(img1, title, img2)

                    divLogos.appendChild(logos)

                    const inputDesc = document.getElementById('inputDesc').value
                    
                    const titleDoc = document.createElement('p')
                    titleDoc.className = 'titleReport'
                    titleDoc.innerText = inputDesc

                    

                    pageDiv.innerHTML = divLogos.innerHTML

                    pageDiv.appendChild(titleDoc);

                    
                    const divImages =  document.createElement('div')
                    divImages.className = 'photoContainerDynamic'
                    

                    // Adicione 3 imagens à div
                    for (let j = 0; j < 3 && i + j < images.length; j++) {

                        const imgElement = document.createElement('img');
                        imgElement.src = images[i + j].src; // Alterado para usar reader.result diretamente

                        imgElement.className = 'photo';                        
                        divImages.appendChild(imgElement)
                        pageDiv.appendChild(divImages);
                    }

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
}


const btnPdf = document.getElementById('btnPdf');

btnPdf.addEventListener('click', generatePdf);

function generatePdf() {
    const page = document.getElementById('page');
    

    html2pdf(page, {
        margin: 0,
        filename: 'Teste.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: 'mm',
            format: 'a4',
            orientation: 'portrait',
            border: '1px solid #000', // Adicione esta linha para definir a borda
        },
    });
}

