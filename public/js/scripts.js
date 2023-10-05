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

let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;
            arrowParent.classList.toggle("showMenu");
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector("#botao");
    sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
    }) 

