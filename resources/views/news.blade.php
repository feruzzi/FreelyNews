@extends('layouts.main')
@section('title', 'Freely News | ' . $news_data[0]['title'])
@section('content')
    <div class="d-flex justify-content-center">
        @foreach ($news_data as $news)
            <div class="card news-card-content">
                <div class="card-body">
                    <h1 class="text-center">{{ $news['title'] }}</h1>
                    <small class="d-inline news-category">{{ $news['category'] }}</small>
                    <div class="d-flex justify-content-between">
                        <div class="my-3">
                            <small class="d-block">{{ $news['source'] }}</small>
                            <small class="d-block">{{ $news['date'] }}</small>
                        </div>
                        <div>
                            <a href="{{ $link }}" target="_blank" class="btn-share">Share Link</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <figure class="figure">
                            <img class="figure-img img-fluid rounded" src="{{ $news['img'] }}" alt="{{ $news['title'] }}">
                            <figcaption class="figure-caption">{{ $news['title'] }}</figcaption>
                        </figure>
                    </div>
                    @foreach ($news['content'] as $x => $content)
                        @if (key($content) == 'sub')
                            <h2>{{ $content['sub'] }}</h2>
                        @elseif(key($content) == 'p')
                            <p>{{ $content['p'] }}</p>
                        @elseif(key($content) == 'list')
                            <li>{{ $content['list'] }}</li>
                        @elseif(key($content) == 'img')
                            <div class="d-flex justify-content-center">
                                <figure class="figure">
                                    <img class="figure-img img-fluid rounded" src="{{ $content['img'] }}"
                                        alt="{{ $content['caption'] }}">
                                    <figcaption style="max-width:620px" class="figure-caption">{{ $content['caption'] }}
                                    </figcaption>
                                </figure>
                            </div>
                        @endif
                        {{-- <h1>{{ key($content) }}</h1> --}}
                    @endforeach
                    <p>Source : <a href="{{ $link }}">{{ $link }}</a></p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
