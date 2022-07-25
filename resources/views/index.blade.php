@extends('layouts.main')
@section('title', 'Home')
@section('content')
    <div class="my-4">
        <h5 class="news-section">Berita Terbaru</h5>
    </div>
    <div class="row">
        @foreach ($news_data as $news)
            <div class="col-sm-6 col-md-4">
                <div class="card mb-3 news-card">
                    <img src="{{ $news['img'] }}" class="card-img-top news-img" alt="{{ $news['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title news-title">{{ $news['title'] }}</h5>
                        <p class="card-text news-text">{{ $news['highline'] }}</p>
                        <div class="d-flex align-items-end">
                            <div>
                                <p class="card-text"><small class="news-category">{{ $news['category'] }}</small></p>
                                <p class="card-text">
                                    <small class="text-muted d-block">{{ $news['source'] }}</small>
                                    <small class="text-muted d-block">{{ $news['date'] }}</small>
                                </p>
                                @php
                                    $link = $news['link'];
                                    $link = urlencode($link);
                                    $link = urlencode($link);
                                @endphp
                                <a class="stretched-link" href="readnews/{{ $news['link'] }}/{{ $news['source'] }}"></a>
                                {{-- <a class="stretched-link" href="readnews/{{ $link }}"></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <div class="fixed-bottom d-flex justify-content-end align-items-end">
        <div class="d-flex justify-content-end align-items-end flex-column">
            <div class="menu-content menu-hide">
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Home</a>
                </div>
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Berita</a>
                </div>
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Teknologi</a>
                </div>
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Bisnis</a>
                </div>
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Showbiz</a>
                </div>
                <div class="my-4 mx-5">
                    <a href="#" class="menu">Etc</a>
                </div>
            </div>
            <button class="menu-nav view-menu" value="view">
                <div class="menu-icon-container">
                    <div class="menu-icon1"></div>
                    <div class="menu-icon2"></div>
                    <div class="menu-icon3"></div>
                </div>
            </button>
        </div>
    </div> --}}
    </div>
@endsection
