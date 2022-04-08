@extends('errors.layout')

@section('content')
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">{{ config('app.name', 'Laravel') }}</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link text-secondary" href="https://dog.ceo/dog-api/" target="_blank">狗狗圖片來源</a>
            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>哦，天啊，你迷路了嗎?</h1>
        <p class="lead">先別擔心，給你看一下這隻可愛的狗狗，我們總會找到出口的</p>
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ $dog_img_src ?? '' }}" alt="可愛的狗溝" style="max-height:300px">
        </div>
        <p class="lead">
            <a href="https://groulox.com" class="btn btn-lg btn-primary fw-bold">前往Groulox</a>
        </p>
    </main>
@endsection