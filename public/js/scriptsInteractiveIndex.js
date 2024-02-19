/* Scrip para enviar formulário ao selecionar arquivo */
// Adicionar um ouvinte de evento para o input de arquivo
document.getElementById('kmlFile').addEventListener('change', function () {
    // Envie o formulário quando um arquivo for selecionado
    this.closest('form').submit();
});
/* Fim script para enviar formulário ao selecionar arquivo */


/* Script para pesquisar não página do mapa */
/* const search = document.getElementById('searchData')
const btnSearch = document.getElementById('btnSearch')
const filter = document.getElementById('filter')

search.addEventListener('keypress', function (event) {
    
   
    if (event.key === 'Enter' && event.target === search) {
        btnSearch.click()
        //search.value = ''        
    }
})

filter.addEventListener('click', function () {
    btnSearch.click()
    //search.value = ''
}) */
/* Fim do script para pesquisa */


