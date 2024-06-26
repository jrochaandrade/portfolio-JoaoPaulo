const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwtich = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

    window.addEventListener("resize", checkWindowSize);

// Evento click botão fechar ou abrir sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});



/* Scrit  para fechar sidebar quando tela for menor que 768 */
function checkWindowSize() {
    console.log("Função checkWindowSize está sendo executada.");
    if (window.innerWidth <= 768) {
        if (!sidebar.classList.contains("close")) {
            closeSidebar();
        }
    } else {
        if (!sidebar.classList.contains("close")) {
            openSidebar();
        }
        
    }
}
// Função para fechar o sidebar
function closeSidebar() {
    sidebar.classList.add("close");
}
// Função para abrir o sidebar
function openSidebar() {
    sidebar.classList.remove("close");
}
/* Fim script para fechar sidebar quando a tela for menor que 768 */



// Feche o sidebar quando a página for carregada pela primeira vez
closeSidebar();

/* Script para abrir o navbar ao clicar no icone da lupa */
/* const searchBox = document.getElementById('search-box')
const searchInput = document.getElementById('searchData')

searchBox.addEventListener('click', function () {
    openSidebar()
    searchInput.focus()
    searchInput.selectionStart = searchInput.selectionEnd = searchInput.value.length;
}) */
/* Fim do script para abrir o navbar ao clicar no icone da lupa */

const sun = document.getElementById('sun');
const moon = document.getElementById('moon');

/* Script para mudar o tema */
modeSwtich.addEventListener("click", function () {

    document.body.classList.toggle('dark')
    document.body.classList.toggle('light')
    
    //body.classList.toggle("dark");
    const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Light Mode"
        moon.style.display = 'none';
        sun.style.display = 'block';
    }else{
        modeText.innerText = "Dark Mode"
        moon.style.display = 'block';
        sun.style.display = 'none';
    }
});

/* Fim do script para mudar o tema */


    
/* Script para manter o tema */
// Função para verificar e aplicar o tema salvo no armazenamento local
function applySavedTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark');
    } else {
        body.classList.add('light');
    }
}
applySavedTheme()
/* Fim script para manter o tema */

document.getElementById('ancoraLogout').addEventListener('click', function (event) {
    
    event.preventDefault()

    document.getElementById('btnLogoutHidden').click()
})



