/* Script para mudar entre inputs de tamanho desmatamento e quantidade de madeira */
const selectTypeAI = document.getElementById('selectTypeAI')
selectTypeAI.addEventListener('change', function () {
    const divDeforestationSize = document.getElementById('divDeforestationSize')
    const divQuantityWood = document.getElementById('divQuantityWood')
    if(selectTypeAI.value === 'logging') {
        divDeforestationSize.style.display = 'block'
        divQuantityWood.style.display = 'none'
    } else {
        divQuantityWood.style.display = 'block'
        divDeforestationSize.style.display = 'none'
    }    
})
/* Fim do script para mudar entre inputs de tamanho desmatamento e quantidade de madeira */


/* Script para vericar se possui embargo e mostar input na tela */
const optionsEmbargo = document.getElementsByName('yesOrNoEmbargos')
const labelEmbargo = document.getElementById('labelEmbargo')
const inputEmbargo = document.getElementById('inputEmbargo')

if (optionsEmbargo[0].value === 'yes' && optionsEmbargo[0].checked) {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)
} else {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)

}    
/* Fim script para verificar se possui embargo e mostrar input na tela */

/* Script para vericar se possui planilha de madeira serrada e mostar input na tela */
const optionsLumber = document.getElementsByName('yesOrNoLumber')
const labelLumber = document.getElementById('labelLumber')
const inputLumber = document.getElementById('inputLumber')

if (optionsLumber[0].value === 'yes' && optionsLumber[0].checked) {
    radioYesOrNo(optionsLumber, labelLumber, inputLumber)
} else {
    radioYesOrNo(optionsLumber, labelLumber, inputLumber)

}    
/* Fim script para verificar se possui planilha de madeira serrada e mostrar input na tela */

/* Script para vericar se possui planilha de madeira in-natura e mostar input na tela */
const optionsNaturalWood = document.getElementsByName('yesOrNoNaturalWood')
const labelNaturalWood = document.getElementById('labelNaturalWood')
const inputNaturalWood = document.getElementById('inputNaturalWood')

if (optionsNaturalWood[0].value === 'yes' && optionsNaturalWood[0].checked) {
    radioYesOrNo(optionsNaturalWood, labelNaturalWood, inputNaturalWood)
} else {
    radioYesOrNo(optionsNaturalWood, labelNaturalWood, inputNaturalWood)

}    
/* Fim script para verificar se possui planilha de madeira in-natura e mostrar input na tela */

/* Script para vericar se possui planilha de madeira in-natura e mostar input na tela */
const optionsImageLetter = document.getElementsByName('yesOrNoImageLetter')
const labelImageLetter = document.getElementById('labelImageLetter')
const inputImageLetter = document.getElementById('inputImageLetter')

if (optionsImageLetter[0].value === 'yes' && optionsImageLetter[0].checked) {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)
} else {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)

}    
/* Fim script para verificar se possui planilha de madeira in-natura e mostrar input na tela */

// Função para mostar os inputs
function actionDynamicShow(label, input) {
    label.style.display = 'block'
    input.style.display = 'block'
}

//Função para ocultar os inputs
function actionDynamicHidden(label, input) {
    label.style.display = 'none'
    input.style.display = 'none'
}

//Função para verificar se o usuario escolheu sim ou não e chama a função para mostar ou ocultar os inputs
function radioYesOrNo(options, label, input) {
    for (let i = 0; i < options.length; i++) {
        options[i].addEventListener('change', function () {
            if (this.checked && this.value === 'yes') {
                actionDynamicShow(label, input)
            }else if (this.checked && this.value === 'no') {
                actionDynamicHidden(label, input)
            }
        })
        
    }
}

/* document.getElementById('generateReport').addEventListener('click', () => {
    const main = document.getElementById('main').outerHTML

    const newTab = window.open('', '_black')

    newTab.document.write('<html><head><title>Relatório Circunstanciado</title></head><body>')
    newTab.document.write(main)
    newTab.document.write('</body></html>')

    newTab.document.close()
}) */