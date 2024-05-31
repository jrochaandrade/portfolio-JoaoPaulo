/* Click no icone para abrir navbar */
const toggle2 = document.querySelector('#logoIndex');
const toggle3 = document.querySelector('#logoIndex2');
// Fechar ou abrir sidebar ao clicar no logo
toggle2.addEventListener('click', () => {
    sidebar.classList.toggle('close');
});

toggle3.addEventListener('click', () => {
    sidebar.classList.toggle('close');
});

/* Desvanecer foto */
window.addEventListener('scroll', function () {
    let fadeContainer = document.querySelector('.imageMain');
    let scrollPosition = window.scrollY;
    let fadeHeight = fadeContainer.offsetHeight;

    // Calcula a opacidade com base na posição de rolagem
    let opacity = 1 - scrollPosition / fadeHeight;

    // Garante que a opacidade seja entre 0 e 1
    if (opacity >= 0 && opacity <= 1) {
        fadeContainer.style.opacity = opacity;
    } else if (opacity < 0) {
        fadeContainer.style.opacity = 0;
    }
});

/* Reduz o tamanho do header ao abrir navbar */
document.getElementById('logoIndex2').addEventListener('click', function () {
    let headerIndex = document.getElementById('headerIndex');
    headerIndex.classList.toggle('headerIndexSmaller');
});


/* Mudança de tema */
document.addEventListener('DOMContentLoaded', function () {
    const sun = document.getElementById('sun');
    const moon = document.getElementById('moon');
    const body = document.body;

    // Função para alternar o tema
    function theme() {
        body.classList.toggle('dark');
        body.classList.toggle('light');

        const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
        localStorage.setItem('theme', currentTheme);

        if (body.classList.contains('dark')) {
            modeText.innerText = 'Light Mode';
        } else {
            modeText.innerText = 'Dark Mode';
        }
    }

    // Carrega o estado do tema do localStorage
    function loadTheme() {
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            body.classList.add('dark');
            body.classList.remove('light');
            moon.style.display = 'none';
            sun.style.display = 'block';
            modeText.innerText = 'Light Mode';
        } else {
            body.classList.add('light');
            body.classList.remove('dark');
            moon.style.display = 'block';
            sun.style.display = 'none';

            modeText.innerText = 'Dark Mode';
        }
    }

    // Inicializa o tema ao carregar a página
    loadTheme();

    sun.addEventListener('click', function () {
        theme();
        moon.style.display = 'block';
        sun.style.display = 'none';
    });

    moon.addEventListener('click', function () {
        theme();
        moon.style.display = 'none';
        sun.style.display = 'block';
    });
});


/* Efeito desvanecer sections e entrada lateral */

const myObserver = new IntersectionObserver( (entries) => {
    console.log(entries)
    entries.forEach( (entry) => {
        if(entry.isIntersecting) {
            entry.target.classList.add('show')
        } else {
            entry.target.classList.remove('show')
        }
    })
})

const elements = document.querySelectorAll('.hidden')

elements.forEach( (element) => myObserver.observe(element))


/* Click imagem para aumentar */
const images = document.querySelectorAll('.projectImage1')

images.forEach(image => {
    image.addEventListener('click', () => {
        image.classList.toggle('enlarged')
    })

    image.addEventListener('mouseleave', () => {
        image.classList.remove('enlarged')
    })
})
