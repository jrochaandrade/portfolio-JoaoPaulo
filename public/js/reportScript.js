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

            // Aguarde que todos os elementos de imagem sejam criados
            Promise.all(imgElements)
                .then(images => {
                    // Adicione os elementos de imagem ao contêiner na ordem correta
                    const photoContainer = document.getElementById('photoContainer');
                    photoContainer.innerHTML = '';
                    images.forEach(imgElement => {
                        photoContainer.appendChild(imgElement);
                    });
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
            margin: 10,
            filename: 'Teste.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        });
    }





