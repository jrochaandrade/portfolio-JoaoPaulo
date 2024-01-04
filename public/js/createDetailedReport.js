/* Script para mudar ocultar inputs relacionados as infrações */
const selectTypeAI = document.getElementById('selectTypeAI')
selectTypeAI.addEventListener('change', function () {
    const divDeforestationSize = document.getElementById('divDeforestationSize')
    //const divQuantityWood = document.getElementById('divQuantityWood')
    const divEmbargos = document.getElementById('divEmbargos')
    //const divLumber = document.getElementById('divLumber')
    //const divNaturalWood = document.getElementById('divNaturalWood')
    const divInputEmbargo = document.getElementById('divInputEmbargo')
    const divInputImageletter = document.getElementById('divInputImageletter')
    
    if(selectTypeAI.value === 'logging') {
        divDeforestationSize.style.display = 'block'
        divEmbargos.style.display = 'block'
        //divQuantityWood.style.display = 'none'
        //divLumber.style.display = 'none'
        //divNaturalWood.style.display = 'none'
        divInputEmbargo.style.display = 'block'
        divInputImageletter.style.display = 'block'
    } else {
        //divQuantityWood.style.display = 'block'
        divDeforestationSize.style.display = 'none'
        divEmbargos.style.display = 'none'
        //divLumber.style.display = 'block'
        //divNaturalWood.style.display = 'block'
        divInputEmbargo.style.display = 'none'
        divInputImageletter.style.display = 'none'
    }    
})
/* Fim do script para mudar ocultar inputs relacionados as infrações */

/* Script para vericar se possui embargo e mostar input na tela */
const optionsEmbargo = document.getElementsByName('yesOrNoEmbargos')
const labelEmbargo = document.getElementById('labelEmbargo')
const inputEmbargo = document.getElementById('inputEmbargo')

if (optionsEmbargo[0].value === 'yes' && optionsEmbargo[0].checked) {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)
} else if (optionsEmbargo[1].value === 'no' && optionsEmbargo[1].checked) {
    radioYesOrNo(optionsEmbargo, labelEmbargo, inputEmbargo)
    

}    
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
const optionsImageLetter = document.getElementsByName('yesOrNoImageLetter')
const labelImageLetter = document.getElementById('labelImageLetter')
const inputImageLetter = document.getElementById('inputImageLetter')

if (optionsImageLetter[0].value === 'yes' && optionsImageLetter[0].checked) {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)
} else {
    radioYesOrNo(optionsImageLetter, labelImageLetter, inputImageLetter)

}    
/* Fim script para verificar se possui planilha de madeira in-natura e mostrar input na tela */




/* Script para vericar se possui atenuantes e mostar na tela */
/* const optionsMitigating= document.getElementsByName('yesOrNoMitigating')
const divMitigating = document.getElementById('divMitigating')


if (optionsMitigating[0].value === 'yes' && optionsMitigating[0].checked) {
    radioYesOrNo(optionsMitigating, divMitigating)
} else {
    radioYesOrNo(optionsMitigating, divMitigating)

}    */ 
/* Fim script para verificar se possui atenuantes e mostrar na tela */

/* Script para vericar se possui agravantes e mostar na tela */
/* const optionsAggravating= document.getElementsByName('yesOrNoAggravating')
const divAggravating = document.getElementById('divAggravating')


if (optionsAggravating[0].value === 'yes' && optionsAggravating[0].checked) {
    radioYesOrNo(optionsAggravating, divAggravating)
} else {
    radioYesOrNo(optionsAggravating, divAggravating)

}    */ 
/* Fim script para verificar se possui agravantes e mostrar na tela */



// Função para mostar os inputs
function actionDynamicShow(label, input) {
    label.style.display = 'block'
    input.style.display = 'block'
}

//Função para ocultar os inputs
function actionDynamicHidden(label, input) {
    label.style.display = 'none'
    input.style.display = 'none'
    input.value = null
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



/* Script para vericar se possui objetos apreendidos e mostar na tela */
const optionsSeizedObjects= document.getElementsByName('yesOrNoSeizedObjects')
const divSeizedObjects = document.getElementById('divSeizedObjects')
const inputTermOfSeizure = document.getElementById('inputTermOfSeizure')
const inputSeizedObjects = document.getElementById('inputSeizedObjects')
const inputDepositLocation = document.getElementById('inputDepositLocation')
const inputNameFaithful = document.getElementById('inputNameFaithful')
const inputNameresponsible = document.getElementById('inputNameresponsible')


if (optionsSeizedObjects[0].value === 'yes' && optionsSeizedObjects[0].checked) {
    radioYesOrNoDiv(optionsSeizedObjects, divSeizedObjects)
} else {
    radioYesOrNoDiv(optionsSeizedObjects, divSeizedObjects, inputTermOfSeizure, inputSeizedObjects, inputDepositLocation, inputNameFaithful, inputNameresponsible)

}    
/* Fim script para verificar se possui objetos apreendidos e mostrar na tela */





// Função para mostar a div objetos apreendidos
function actionDynamicShowDiv(div) {
    div.style.display = 'block'
}

//Função para ocultar a div objetos apreendidos
function actionDynamicHiddenDiv(div, input, input2, input3, input4, input5) {
    div.style.display = 'none'
    
    input.value = null
    input2.value = null
    input3.value = null
    input4.value = null
    input5.value = null
    
}

//Função para verificar se o usuario escolheu sim ou não e chama a função para mostar ou ocultar a div objetos apreendidos
function radioYesOrNoDiv(options, div, input, input2, input3, input4, input5) {
    for (let i = 0; i < options.length; i++) {
        options[i].addEventListener('change', function () {
            if (this.checked && this.value === 'yes') {
                actionDynamicShowDiv(div)
            }else if (this.checked && this.value === 'no') {
                actionDynamicHiddenDiv(div, input, input2, input3, input4, input5)
            }
        })
        
    }
}


const optionsMitigating = document.getElementsByName('yesOrNoMitigating');
const divMitigating = document.getElementById('divMitigating');
const checkboxesMitigating = document.querySelectorAll('input[name="mitigating[]"]');

// Inicialmente, ocultar ou mostrar a div com base na opção selecionada
radioYesOrNoMitigatingAgravating(optionsMitigating, divMitigating, checkboxesMitigating);


const optionsAggravating = document.getElementsByName('yesOrNoAggravating');
const divAggravating = document.getElementById('divAggravating');
const checkboxesAggravating = document.querySelectorAll('input[name="aggravating[]"]');


// Inicialmente, ocultar ou mostrar a div com base na opção selecionada
radioYesOrNoMitigatingAgravating(optionsAggravating, divAggravating, checkboxesAggravating);


// Adicionar evento de mudança para a opção "Sim" ou "Não" - marca ou desmarca os checkboxs
for (let i = 0; i < optionsMitigating.length; i++) {
    optionsMitigating[i].addEventListener('change', function () {
        // Verificar a opção selecionada e mostrar/ocultar a div
        radioYesOrNoMitigatingAgravating(optionsMitigating, divMitigating, checkboxesMitigating);

        // Se a opção for "Não", desmarcar todas as opções
        if (this.checked && this.value === 'no') {
            checkboxesMitigating.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });
}

// Função para mostrar ou ocultar a div e as opções
function radioYesOrNoMitigatingAgravating(options, label, checkboxes) {
    for (let i = 0; i < options.length; i++) {
        options[i].addEventListener('change', function () {
            if (this.checked && this.value === 'yes') {
                dynamicShowMitigatingAgravating(label, checkboxes);
            } else if (this.checked && this.value === 'no') {
                dynamicHiddenMitigatingAgravating(label, checkboxes);
            }
        });
    }
}

// Função para mostrar os inputs
function dynamicShowMitigatingAgravating(label, checkboxes) {
    label.style.display = 'block';
    checkboxes.forEach(checkbox => {
        checkbox.parentElement.style.display = 'block';
    });
}

// Função para ocultar os inputs
function dynamicHiddenMitigatingAgravating(label, checkboxes) {
    label.style.display = 'none';
    checkboxes.forEach(checkbox => {
        checkbox.parentElement.style.display = 'none';
        checkbox.checked = false; // Desmarcar as opções ao ocultar
    });
}




    /* $(document).ready(function () {
        $('#birthday').inputmask('99/99/9999', { placeholder: '__/__/____' });
    });
 */

    $(document).ready(function () {
        $('#phone').inputmask('(99) 99999-9999', { placeholder: '(__) _____-____' });
    });


    $(document).ready(function () {
        $('#cpf').inputmask('999.999.999-99', { placeholder: '___.___.___-__' });
    });










































/* document.getElementById('generateReport').addEventListener('click', () => {
    const main = document.getElementById('main').outerHTML

    const newTab = window.open('', '_black')

    newTab.document.write('<html><head><title>Relatório Circunstanciado</title></head><body>')
    newTab.document.write(main)
    newTab.document.write('</body></html>')

    newTab.document.close()
}) */


