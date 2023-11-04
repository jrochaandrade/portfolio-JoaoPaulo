const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwtich = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

    window.addEventListener("resize", checkWindowSize);

    applySavedTheme()

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

// Feche o sidebar quando a página for carregada pela primeira vez
closeSidebar();

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});


modeSwtich.addEventListener("click", () => {
    body.classList.toggle("dark");
    const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
    if(body.classList.contains("dark")){
        modeText.innerText = "Light Mode"
    }else{
        modeText.innerText = "Dark Mode"
    }
});


    
/* Script para manter o tema */

// Função para verificar e aplicar o tema salvo no armazenamento local
function applySavedTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark');
    } else {
        body.classList.remove('dark');
    }
}

// Adicione um ouvinte de evento para verificar a preferência do tema ao carregar a página
/* document.addEventListener('DOMContentLoaded', applySavedTheme);

// Adicione um ouvinte de evento para o botão de alternância de tema
modeSwtich.addEventListener('click', () => {
    body.classList.toggle('dark');
    const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
});
 */