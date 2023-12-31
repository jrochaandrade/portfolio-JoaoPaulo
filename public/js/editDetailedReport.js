/* Script para mudar entre inputs de tamanho desmatamento e quantidade de madeira */
document.addEventListener("DOMContentLoaded", function() {
    const selectTypeAI = document.getElementById('selectTypeAI');
    const divDeforestationSize = document.getElementById('divDeforestationSize');
    const divQuantityWood = document.getElementById('divQuantityWood');
    //const divEmbargos = document.getElementById('divEmbargos');
    const divLumber = document.getElementById('divLumber');
    const divNaturalWood = document.getElementById('divNaturalWood');
    //const divInputEmbargo = document.getElementById('divInputEmbargo');
    //const divInputImageletter = document.getElementById('divInputImageletter');

    function updateFormVisibility() {
        if (selectTypeAI.value === 'logging') {
            divDeforestationSize.style.display = 'block';
            //divEmbargos.style.display = 'block';
            //divInputEmbargo.style.display = 'block';
           // divInputImageletter.style.display = 'block';
        } else {
            divDeforestationSize.style.display = 'none';
            //divEmbargos.style.display = 'none';
            //divInputEmbargo.style.display = 'none';
            //divInputImageletter.style.display = 'none';
        }
    }

    // Atualiza a visibilidade ao carregar a página
    updateFormVisibility();

    // Adiciona um ouvinte para o evento 'change'
    selectTypeAI.addEventListener('change', updateFormVisibility);
});

/* Fim do script para mudar entre inputs de tamanho desmatamento e quantidade de madeira */

/* Script para vericar se possui embargo e mostar input na tela */
/* const optionsEmbargo = document.getElementsByName('yesOrNoEmbargos')
const labelEmbargo = document.getElementById('labelEmbargo')
const inputEmbargo = document.getElementById('inputEmbargo')

if (optionsEmbargo[0].value === 'yes' && optionsEmbargo[0].checked) {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)
} else {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)

}   */  
/* Fim script para verificar se possui embargo e mostrar input na tela */

/* Script para vericar se possui planilha de madeira serrada e mostar input na tela */
/* const optionsLumber = document.getElementsByName('yesOrNoLumber')
const labelLumber = document.getElementById('labelLumber')
const inputLumber = document.getElementById('inputLumber')

if (optionsLumber[0].value === 'yes' && optionsLumber[0].checked) {
    radioYesOrNo(optionsLumber, labelLumber, inputLumber)
} else {
    radioYesOrNo(optionsLumber, labelLumber, inputLumber)

}  */   
/* Fim script para verificar se possui planilha de madeira serrada e mostrar input na tela */

/* Script para vericar se possui planilha de madeira in-natura e mostar input na tela */
/* const optionsNaturalWood = document.getElementsByName('yesOrNoNaturalWood')
const labelNaturalWood = document.getElementById('labelNaturalWood')
const inputNaturalWood = document.getElementById('inputNaturalWood')

if (optionsNaturalWood[0].value === 'yes' && optionsNaturalWood[0].checked) {
    radioYesOrNo(optionsNaturalWood, labelNaturalWood, inputNaturalWood)
} else {
    radioYesOrNo(optionsNaturalWood, labelNaturalWood, inputNaturalWood)

}   */  
/* Fim script para verificar se possui planilha de madeira in-natura e mostrar input na tela */

/* Script para vericar se possui planilha de madeira in-natura e mostar input na tela */
/* const optionsImageLetter = document.getElementsByName('yesOrNoImageLetter')
const labelImageLetter = document.getElementById('labelImageLetter')
const inputImageLetter = document.getElementById('inputImageLetter')

if (optionsImageLetter[0].value === 'yes' && optionsImageLetter[0].checked) {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)
} else {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)

}  */   
/* Fim script para verificar se possui planilha de madeira in-natura e mostrar input na tela */


/* Script para vericar se possui atenuantes e mostar na tela */
const optionsMitigating= document.getElementsByName('yesOrNoMitigating')
const divMitigating = document.getElementById('divMitigating')


if (optionsMitigating[0].value === 'yes' && optionsMitigating[0].checked) {
    radioYesOrNo(optionsMitigating, divMitigating)
} else {
    radioYesOrNo(optionsMitigating, divMitigating)

}    
/* Fim script para verificar se possui atenuantes e mostrar na tela */

/* Script para vericar se possui atenuantes e mostar na tela */
const optionsAggravating= document.getElementsByName('yesOrNoAggravating')
const divAggravating = document.getElementById('divAggravating')


if (optionsAggravating[0].value === 'yes' && optionsAggravating[0].checked) {
    radioYesOrNo(optionsAggravating, divAggravating)
} else {
    radioYesOrNo(optionsAggravating, divAggravating)

}    
/* Fim script para verificar se possui atenuantes e mostrar na tela */

/* Script para vericar se possui atenuantes e mostar na tela */
const optionsSeizedObjects= document.getElementsByName('yesOrNoSeizedObjects')
const divSeizedObjects = document.getElementById('divSeizedObjects')


if (optionsSeizedObjects[0].value === 'yes' && optionsSeizedObjects[0].checked) {
    radioYesOrNo(optionsSeizedObjects, divSeizedObjects)
} else {
    radioYesOrNo(optionsSeizedObjects, divSeizedObjects)

}    
/* Fim script para verificar se possui atenuantes e mostrar na tela */

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