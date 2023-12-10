
/* Scrip para enviar formulário ao selecionar arquivo */
// Adicionar um ouvinte de evento para o input de arquivo
document.getElementById('kmlFile').addEventListener('change', function () {
    // Envie o formulário quando um arquivo for selecionado
    this.closest('form').submit();
});
/* Fim script para enviar formulário ao selecionar arquivo */


/* Script para pesquisa */
const search = document.getElementById('search')
const btnSearch = document.getElementById('btnSearch')

search.addEventListener('keypress', function (event) {
    
   
    if (event.key === 'Enter') {
        btnSearch.click()
    }
})
/* Fim do script para pesquisa */


