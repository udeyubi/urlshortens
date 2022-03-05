@extends('layouts.app')

@section('content')
    <form action="{{route('urlshorts.store')}}" method="POST">
        @CSRF
        <div class="input-group">
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="Enter Your Link Here" autocomplete="off" value="{{ old('url') }}">
            <button class="btn btn-outline-secondary" type="submit">縮址</button>
        </div>
    </form>
    @error('url')
        <p class="fw-bolder text-danger">{{ $message }}</p>
    @enderror
    

    @if ( isset($shorten_url) )
        <div class="position-absolute w-50 top-50 start-50 translate-middle text-center">
            <p class="fs-4 fw-bolder text-success">短網址已準備完成!</p>
            <div class="input-group mb-1">
                <input type="text" id="shortenURL" class="form-control" value="{{ $shorten_url }}" readonly>
                <button class="btn btn-outline-secondary" type="button" id="copyButton" onclick="copy()">複製!</button>
            </div>
            <div class="text-start text-break">
                原網址：
                <a class="" href="{{ $url }}" target="_blank">{{ $url }}</a>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        function copy(){
            var content = document.getElementById('shortenURL');
            content.select();
            document.execCommand("Copy"); // 執行瀏覽器複製命令
            document.getElementById('copyButton').focus();
            alert("已複製!");
        }
    </script>
@endsection