<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Exception;

class News
{
    public $title;
    public $date;
    public $img;
    public $link;
    public $source;
    public $highline;
    public $category;

    function __construct(
        $title,
        $date,
        $img,
        $link,
        $source,
        $highline,
        $category
    ) {
        $this->title = $title;
        $this->date = $date;
        $this->img = $img;
        $this->link = $link;
        $this->source = $source;
        $this->highline = $highline;
        $this->category = $category;
    }
}
class NewsContent
{
    public $title;
    public $date;
    public $img;
    public $source;
    public $content;
    public $category;

    function __construct(
        $title,
        $date,
        $img,
        $source,
        $content,
        $category
    ) {
        $this->title = $title;
        $this->date = $date;
        $this->img = $img;
        $this->source = $source;
        $this->content = $content;
        $this->category = $category;
    }
}
function getDetikNews()
{
    $client = new Client();

    $res = $client->request('GET', 'https://www.detik.com');
    $shtml = str_get_html($res->getBody());
    for ($i = 0; $i < 10; $i++) {
        if ($shtml->find('div.nhl div.list-content div.media__text h3', $i)->plaintext)
            $judul[] = $shtml->find('div.nhl div.list-content div.media__text h3', $i)->plaintext;
        // $time = $shtml->find('article:nth-child(2) div div.media__text div span', 0)->plaintext;
        // $img = $shtml->find('article:nth-child(2) div div.media__image a span img', 0)->src;
    }
    dd($judul);
}
function getCnnNews()
{
    $client = new Client();

    $res = $client->request('GET', 'https://www.cnnindonesia.com');
    $shtml = str_get_html($res->getBody());
    for ($i = 0; $i < 10; $i++) {
        try {
            //!!GET Info
            $title = $shtml->find('div.l_content article span.box_text h2.title ', $i)->plaintext;
            $date = $shtml->find('div.l_content span.box_text span.date', $i)->plaintext;
            $date = str_replace(" &bull; ", "", $date);
            $img = $shtml->find('div.l_content article span.box_img img', $i)->src;
            // !!Link encode 2 kali
            $link = $shtml->find('div.l_content article a', $i)->getAttribute('href');
            $source = "CNN Indonesia";
            $category = $shtml->find('div.l_content span.box_text span.kanal', $i)->plaintext;

            //!! GET CONTENT
            $res_content = $client->request('GET', $link);
            $shtml_content = str_get_html($res_content->getBody());
            $highline = $shtml_content->find('div.detail_text p', 0)->plaintext;
            $link = urlencode($link);
            $link = urlencode($link);
            $link = urlencode($link);
            $cnn_news[] = new News($title, $date, $img, $link, $source, $highline, $category);

            // foreach ($content->find('p') as $p) {
            //     if ($p->getAttribute('id')) {
            //     } else {
            //         $paragraph[] = $p->plaintext;
            //     }
            // }
            // $cnn_news_content[] = new NewsContent($content_title, $content_date, $content_img, $content_source, $paragraph);
        } catch (Exception $e) {
        }
    }
    return (json_encode($cnn_news));
}
function readCnnNews($link, $source)
{
    // dd("hai");
    $client = new Client();

    $res_content = $client->request('GET', $link);
    $shtml_content = str_get_html($res_content->getBody());
    $content_title = $shtml_content->find('div.content_detail h1.title', 0)->plaintext;
    $content_category = $shtml_content->find('div.content_detail div.breadcrumb a', 2)->plaintext;
    $content_source = $source;
    $content_date = $shtml_content->find('div.content_detail div.date', 0)->plaintext;
    $content_img = $shtml_content->find('div.content_detail div.media_artikel img', 0)->src;
    $content = $shtml_content->find('div.detail_text', 0);
    // dd($content->children);
    $paragraph = [];
    $next_contents = [];
    $img_index = 0;
    foreach ($content->children as $i => $p) {
        // !!Jangan Hapus Start
        if ($p->tag == 'p') {
            $paragraph[]['p'] = $p->plaintext;
        } elseif ($p->tag == 'h1' || $p->tag == 'h2' || $p->tag == 'h3') {
            $paragraph[]['sub'] = $p->plaintext;
        } elseif ($p->tag == 'table' && $p->getAttribute('class') == 'pic_artikel_sisip_table') {
            $paragraph[$i]['img'] =  $shtml_content->find('div.detail_text table.pic_artikel_sisip_table div.pic img', $img_index)->src;
            $paragraph[$i]['caption'] =  $shtml_content->find('div.detail_text table.pic_artikel_sisip_table div.pic', $img_index)->plaintext;
            $img_index++;
        } elseif ($p->tag == 'ul') {
            foreach ($p->find('li') as $list) {
                $paragraph[]['list'] = $list->plaintext;
            }
        }
        //!!Buat next article Start
        // elseif ($p->tag == 'div' && $p->getAttribute('class') == 'grid_row nav_article_long') {
        //     $next_contents[] = $p->find('a', 0)->getAttribute('href');
        // }
        //!!next article End
        // !!Jangan Hapus END
        // if ($p->tag == 'div' && $p->getAttribute('class') == 'anchor_article_long') {
        //     foreach ($p->find('a') as $next_link) {
        //         $next_contents[] = $next_link->getAttribute('href');
        //     }
        // }
        // if ($next_contents) {
        //     foreach ($next_contents as $n_content) {
        //         $res_n_content = $client->request('GET', $n_content);
        //         $n_shtml_content = str_get_html($res_n_content->getBody());
        //         $n_content = $n_shtml_content->find('div.detail_text', 0);
        //     }
        // }
        // $paragraph[] = $p->tag;
        // dd($p->tag);
        // if ($p->getAttribute('id')) {
        // } else {
        //     $paragraph[] = $p->plaintext;
        // }
    }
    // dd($next_contents);
    // dd($paragraph);
    $cnn_news_content[] = new NewsContent($content_title, $content_date, $content_img, $source, $paragraph, $content_category);
    return ($cnn_news_content);
}
include(app_path() . "\Http\Controllers\simplehtmldom\simplehtmldom.php");
class NewsController extends Controller
{
    private $client;
    public function __construct()
    {
        $this->client = new Client([
            'timeout'   => 10,
            'verify'    => false
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client();
        $test = "helllooo";
        return new NewsResource(true, 'Listed', $test);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getNews(Request $request)
    {
        // return (getDetikNews());
        // !!Get News CNN Start JANGAN HAPUS
        return (getCnnNews());
        // !!END CNN


    }
    public function readNews($link, $source)
    {
        $link = urldecode($link);
        $decode_link = urldecode($link);
        if ($source == 'CNN Indonesia') {
            return ReadCnnNews($decode_link, $source);
        }
    }
}