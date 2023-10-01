@extends('layouts.masterPage')

@section('card-body')

<div class="wrapper">
    <!-- Sidebar -->
    <aside id="sidebar">
        <div class="h-100">
            <div class="sidebar-logo">
                <a href="#">JP</a>
            </div>
        </div>
    </aside>
    <!-- Main Component -->
    <div class="main">
        <nav class=" navbar navbar-expand px-3 border-bottom">
            <!-- Button for sidebar toggle -->
            <button class="btn" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>        
    </div>
</div>

@endsection