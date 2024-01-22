@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous">
</script>


<!-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script> -->


<script src="{{ asset('node_modules/exif-js/exif.js') }}" defer></script>

<script src="{{ asset('js/reportScript.js') }}" defer type="module"></script>


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Fotográfico</h1>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <h5 class="h5">
                Protótipo para geração do relatório fotográfico utilizandos no âmbito do Batalhão de Polícia
                Ambiental.<br><br>
                As fotos podem ser carregadas fora de ordem desde que os metadados das imagens estejam íntegros.<br><br>
                Digite qual a sua unidade, um título para o relatório, carregue as imagens, aguarde até todas as imagens
                serem carregadas
                e em seguida clique em gerar PDF.<br><br>
                Obs.: Se ao baixar o PDF estiver desconfigurado, role a página para visualizar a primeira parte do
                documento em seguinda clique em gerar pdf novamente.<br><br>
                Obs.2: Se estiver usando dispositívo móvel, utilizar o navegador em versão Desktop.
            </h5>
            <label for="inputUnit" id="labelDescription">Unidade</label>
            <input type="text" class="form-control inputUnit" id="inputUnit"
                placeholder="Ex.: 3ª Companhia de Polícia Ambiental" value="3ª Companhia de Polícia Ambiental">
            <label for="inputDesc" id="labelDescription">Título do relatório</label>
            <input type="text" class="form-control inputDesc" id="inputDesc"
                placeholder="Ex.: Relatório Fotográfico Missão Guardiões do Bioma 3 ET/2023 - 01 a 15/05/2023"
                value="Relatório fotográfico ">
            <div class="divButtons">
                <!-- <form action="" method="post" enctype="multipart/form-data">
                @csrf -->
                <label for="fileInput" class="btn btn-primary btnInput">Carregar imagens</label>
                <input type="file" id="fileInput" name="images[]" multiple style="display: none;">
                <button id="btnPdf" class="btn btn-success">Gerar PDF</button>
                <!-- <input type="submit" value="" id="btnSubmit" style="display: none;"> -->
                <!-- </form> -->
                <!-- <button id="createReport" class="btn btn-success">Gerar Relatório</button> -->
            </div>
            <div class="main" id="main">
                <div class="page" id="page">
                    <div class="photoContainer" id="photoContainer"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/* let photos = {!! json_encode($images) !!}
    document.getElementById('fileInput').addEventListener('change', function () {
        const btnSubmit = document.getElementById('btnSubmit')

        btnSubmit.click()
    })


    document.getElementById('createReport').addEventListener('click', function () {
        putImages()
    })


    function putImages() {
        console.log(photos)

        for (let i = 0; i < photos.length; i++){
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
                console.log('testeLop')
            });
            console.log(imgElements)
    }


    } */






/*      
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
    const title = document.createElement('p')
    title.className = 'title'
    title.innerHTML = 'Secretaria de Estado da Segurança, Defesa e Cidadania<br>Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental<br>3ª Companhia de Polícia Ambiental<br>Seção de Planejamento Operacional'
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
               
// Obtem o botão gerar pdf
const btnPdf = document.getElementById('btnPdf');
btnPdf.addEventListener('click', generatePdf);
// Função para gerar o pdf
function generatePdf() {    
    const page = document.getElementById('page');
    const pageWithBorder = document.getElementsByName('pageWithBorder')
    
    const lastDiv = pageWithBorder[pageWithBorder.length - 1];
    
    
    lastDiv.className = 'lastPageWithBorder'

    // Força o recálculo do layout antes de gerar o PDF
    window.dispatchEvent(new Event('resize'));
    
    html2pdf(page, {
        margin: 0,
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
}
*/
</script>

@endsection