<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LNewsController extends Controller
{
    public function index()
    {
        $response = Http::get('localhost:8000/api/getnews');
        $news_data = $response->json();
        return view('index', [
            'title' => "Freely News",

        ], compact('news_data'));
        // return view('index', [
        //     'title' => "Freely News",

        // ]);
        // dd($data);
    }
    public function readnews($link, $source)
    {
        // dd($link, $source);
        // $source = str_replace(" ", "%", $source);
        // dd($link, $source);
        // dd('http://127.0.0.1:8000/api/readnews/' . $link . '/' . $source);
        $response = Http::get('http://127.0.0.1:8000/api/readnews/' . $link . '/' . $source);
        // dd($response);
        $link = urldecode($link);
        $link = urldecode($link);
        $news_data = $response->json();
        // dd($news_data);
        return view('news', [
            'title' => "Freely News",
            'link' => $link,

        ], compact('news_data'));
    }
}