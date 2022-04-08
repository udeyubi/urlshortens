
@extends('errors.layout')

@section('content')
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">{{ config('app.name', 'Laravel') }}</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                {{-- <a class="nav-link text-secondary" href="https://dog.ceo/dog-api/" target="_blank">狗狗圖片來源</a> --}}
            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>哦 ! 不 ! 發生了點問題</h1>
        <p class="lead">工程師正在著手修復這些問題，這通常不會持續太久</p>
        <p class="lead">
            <a href="https://groulox.com" class="btn btn-lg btn-primary fw-bold">前往Groulox</a>
            <a href="mailto:huangahuei@gmail.com
                    ?subject=嗨，我在 {{ Request::url() }} 遇到了一個錯誤!" class="btn btn-lg btn-outline-primary fw-bold">向管理員回報BUG</a>
        </p>
    </main>
@endsection
