
/* Scrip para enviar formulário ao selecionar arquivo */
// Adicionar um ouvinte de evento para o input de arquivo
document.getElementById('kmlFile').addEventListener('change', function () {
    // Envie o formulário quando um arquivo for selecionado
    this.closest('form').submit();
});
/* Fim script para enviar formulário ao selecionar arquivo */



