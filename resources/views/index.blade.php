@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/index/sidebarHome.css') }}">
<script src="{{ asset('js/index/scriptsIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')
<div class="home">
    <div class="text">
        <div class="container-fluid content">
            <div class="headerIndex">
                <span class="">
                    <img id="logoIndex" src="{{ asset('images/LogoDR3-100.jpg') }}" alt="">
                </span>
                <div class="links">
                    <a href="#">Meus projetos</a>
                    <a href="#">Sobre mim</a>
                    <a href="#">Contato</a>
                </div>
            </div>
            <div class="divMain container-fluid">
                <h2>testando</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cupiditate expedita corporis dolores, exercitationem obcaecati quia perferendis! Soluta iste aut labore officia ipsam optio, ullam, atque temporibus corrupti tempore dolores perferendis? Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo voluptatem in laboriosam quas nostrum iusto, facere repellendus mollitia, at saepe delectus. Architecto repellendus velit laborum consequatur incidunt in, officiis fugit?</p>
            </div>
        </div>
    </div>
</div>
@endsection
