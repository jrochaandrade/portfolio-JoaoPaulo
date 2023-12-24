
document.addEventListener('DOMContentLoaded', function () {
    const labelEmbargo = document.getElementById('labelEmbargo')
    const inputEmbargo = document.getElementById('inputEmbargo')
    const options = document.getElementsByName('yesOrNoEmbargos')

    function actionDynamic() {
        labelEmbargo.style.display = 'block'
        inputEmbargo.style.display = 'block'
    }

    function actionDynamic2() {
        labelEmbargo.style.display = 'none'
        inputEmbargo.style.display = 'none'
    }

    for (let i = 0; i < options.length; i++) {
        options[i].addEventListener('change', function () {
            if (this.id === 'yesEmbargos' && this.checked) {
                actionDynamic()
            }else if (this.id === 'noEmbargos' && this.checked) {
                actionDynamic2()
            }
        })
        
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const labelLumber = document.getElementById('labelLumber')
    const inputLumber = document.getElementById('inputLumber')
    const options2 = document.getElementsByName('yesOrNoLumber')

    function actionDynamic() {
        labelLumber.style.display = 'block'
        inputLumber.style.display = 'block'
    }

    function actionDynamic2() {
        labelLumber.style.display = 'none'
        inputLumber.style.display = 'none'
    }

    for (let i = 0; i < options2.length; i++) {
        options2[i].addEventListener('change', function () {
            if (this.id === 'yesLumber' && this.checked) {
                actionDynamic()
            }else if (this.id === 'noLumber' && this.checked) {
                actionDynamic2()
            }
        })
        
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const labelNaturalWood = document.getElementById('labelNaturalWood')
    const inputNaturalWood = document.getElementById('inputNaturalWood')
    const options2 = document.getElementsByName('yesOrNoNaturalWood')

    function actionDynamic() {
        labelNaturalWood.style.display = 'block'
        inputNaturalWood.style.display = 'block'
    }

    function actionDynamic2() {
        labelNaturalWood.style.display = 'none'
        inputNaturalWood.style.display = 'none'
    }

    for (let i = 0; i < options2.length; i++) {
        options2[i].addEventListener('change', function () {
            if (this.id === 'yesNaturalWood' && this.checked) {
                actionDynamic()
            }else if (this.id === 'noNaturalWood' && this.checked) {
                actionDynamic2()
            }
        })
        
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const labelImageLetter = document.getElementById('labelImageLetter')
    const inputImageLetter = document.getElementById('inputImageLetter')
    const options2 = document.getElementsByName('yesOrNoImageLetter')

    function actionDynamic() {
        labelImageLetter.style.display = 'block'
        inputImageLetter.style.display = 'block'
    }

    function actionDynamic2() {
        labelImageLetter.style.display = 'none'
        inputImageLetter.style.display = 'none'
    }

    for (let i = 0; i < options2.length; i++) {
        options2[i].addEventListener('change', function () {
            if (this.id === 'yesImageLetter' && this.checked) {
                actionDynamic()
            }else if (this.id === 'noImageLetter' && this.checked) {
                actionDynamic2()
            }
        })
        
    }
})