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
    

    
    <div class="w-100 d-flex flex-column align-items-center mt-2">
        <div class="w-50 text-center my-2" style="min-height: 115px">
            @if ( isset($shorten_url) )
                <p class="fs-4 fw-bolder text-success">短網址已準備完成!</p>
                <div class="input-group mb-1">
                    <input type="text" id="shortenURL" class="form-control" value="{{ $shorten_url }}" readonly>
                    <button class="btn btn-outline-secondary" type="button" id="copyButton" onclick="copy()">複製!</button>
                </div>
                <div class="text-start text-break">
                    原網址：
                    <a class="" href="{{ $url }}" target="_blank">{{ $url }}</a>
                </div>
            @endif
        </div>

        <div class="w-75 my-2 text-center border-top border-3 pt-2">
            @if( !empty( $url_histories ) )
                <p class="text-black h4 fw-bold">使用紀錄</p>
                <div class="list-group overflow-auto" style="height:375px">
                    @foreach ( $url_histories as $history_row)
                        <a href="/{{$history_row->id}}" target="_blank" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 text-danger fw-bold">{{ $history_row->id }}</h5>
                                <small>點擊次數 : {{ $history_row->used }}</small>
                            </div>
                            <div class="w-100 text-center">
                                <p class="mb-1 text-truncate text-center text-muted" style="white-space: nowrap;">
                                    {{ $history_row->url }}
                                </p>
                            </div>
                            <div class=" d-flex justify-content-between">
                                <small>建立時間：{{ date('Y-m-d H:i:s',strtotime($history_row->created_at)) }}</small>
                                <small>最近使用：{{ date('Y-m-d H:i:s',strtotime($history_row->updated_at)) }}</small>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
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