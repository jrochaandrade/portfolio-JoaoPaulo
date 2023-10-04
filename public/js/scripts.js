const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});


/* Script primera side bar */
const effects = document.querySelectorAll('.effect');

effects.forEach(effect => { 
    effect.addEventListener('mousemove', (e) => {
        const rect = effect.getBoundingClientRect();

        const left = e.clientX - rect.left;
        const top = e.clientY - rect.top;

        effect.style.setProperty("--left", `${left}px`);
        effect.style.setProperty("--top", `${top}px`);
    
    });
});

/* Script segunda sidebar */

