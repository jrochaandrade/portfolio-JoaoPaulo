@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/sideBarStyle.css') }}">

@endsection

@section('card-body')


<div class="sidebar">
    <ul class="nav-links">
        <div class="logo-details">
            <i class="bi bi-cpu"></i>
            <span class="logo_name">Dev Rocha</span>
        </div>
        <li class="mt-3">
            <a href="#">
                <i class="bi bi-grid"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a  class="link_name" href="#">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                    <i class="bi bi-collection"></i>
                    <span class="link_name">Category</span>
                </a>
                <i class="bi bi-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a  class="link_name" href="#">Category</a></li>
                <li><a href="#">HTML & CSS</a></li>
                <li><a href="#">JavaScript</a></li>
                <li><a href="#">PHP & MySQL</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                <i class="bi bi-journal-text"></i>
                    <span class="link_name">Posts</span>
                </a>
                <i class="bi bi-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a  class="link_name" href="#">Posts</a></li>                
                <li><a href="#">Web Design</a></li>
                <li><a href="#">Login Form</a></li>
                <li><a href="#">Card Design</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-grid"></i>
                <span class="link_name">Analytics</span>
            </a>
            <ul class="sub-menu blank">
                <li><a  class="link_name" href="#">Analytics</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="bi bi-grid"></i>
                <span class="link_name">Chart</span>
            </a>
            <ul class="sub-menu blank">
                <li><a  class="link_name" href="#">Chart</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="#">
                <i class="bi bi-journal-text"></i>
                    <span class="link_name">Plugins</span>
                </a>
                <i class="bi bi-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a  class="link_name" href="#">Plugins</a></li>                
                <li><a href="#">Web Design</a></li>
                <li><a href="#">Login Form</a></li>
                <li><a href="#">Card Design</a></li>
            </ul>
        </li>
        <li>
        <div class="profile-details">
            <div class="profile-content">
                <img src="{{ asset('images/LogoDR.jpg') }}" alt="profile">
            </div>
                <div class="name-job">
                    <div class="profile_name">João Paulo</div>
                    <div class="job">Desenvolvedor</div>
                </div>
                <i class="bi bi-door-open"></i>
            </div>
        </li>
    </ul>
</div>

<section class="home-section">
    <div class="home-content">
        <i class="bi bi-list botaofechar"></i>
        <span class="text">Drop Down Sidebar</span>
    </div>
</section>

<script>
    
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;
            console.log(arrowParent);
            arrowParent.classList.toggle("showMenu");
        });
    }

    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bi-list");
    console.log(sidebar);
    sidebarBtn.addEventListener("click", ()=>{
        sidebar.classList.toggle("close");
    })

   /* // Verifica se o estado da barra lateral foi armazenado no localStorage
    const sidebarState = localStorage.getItem("sidebarState");

    if (sidebarState === "closed") {
        // Se o estado for "closed", fecha a barra lateral
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.add("close");
    }

    // Adiciona um evento de clique ao botão para alternar o estado da barra lateral
    const sidebarBtn = document.querySelector(".botaofechar");
    sidebarBtn.addEventListener("click", () => {
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("close");

        // Armazena o estado atual da barra lateral no localStorage
        if (sidebar.classList.contains("close")) {
            localStorage.setItem("sidebarState", "closed");
        } else {
            localStorage.setItem("sidebarState", "open");
        }
    }); */

    

</script>

@endsection