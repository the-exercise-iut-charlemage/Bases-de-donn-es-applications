<?php
require_once 'vendor/autoload.php';

use appdb\models\Game;
use appdb\models\Company;
use appdb\models\Platform;
use \Illuminate\Database\Capsule\Manager as DB;
use Slim\Slim;

$db = new DB();

$db->addConnection(parse_ini_file('db.ini'));

$db->setAsGlobal();
$db->bootEloquent();

$app = new Slim();

$app->get('/', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('tp1-exo1');
    $url2 = $slim->urlFor('tp1-exo2');
    $url3 = $slim->urlFor('tp1-exo3');
    $url4 = $slim->urlFor('tp1-exo4');
    $url5 = $slim->urlFor('tp1-exo5');

    $url6 = $slim->urlFor('tp2-exo1');
    $url7 = $slim->urlFor('tp2-exo2');
    echo <<<html
<div>
    <h1>TP 1:</h1>
    <a href='$url1'>Exo1</a>
    <a href='$url2'>Exo2</a>
    <a href='$url3'>Exo3</a>
    <a href='$url4'>Exo4</a>
    <a href='$url5'>Exo5</a>
</div>
<div>
    <h1>TP 2:</h1>
    <a href='$url6'>Exo1</a>
    <a href='$url7'>Exo2</a>
</div>
html;
})->name('home');

$app->get('/tp1/exo1', function () {
    $exo1 = Game::select('name', 'description')->where('name', 'like', '%mario%')->get();
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP1-Exo 1<br>
html;
    foreach ($exo1 as $values)
    {
        echo '<h1>' . $values->name . '</h1><br><p>' . $values->description . '</p><br><hr><br>';
    }
})->name('tp1-exo1');


$app->get('/tp1/exo2', function () {
    $exo2 = Company::select('name', 'description')->where('location_country', '=', 'japan')->get();
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP1-Exo 2<br>
html;
    foreach ($exo2 as $values)
    {
        echo '<h1>' . $values->name . '</h1><br><p>' . $values->description . '</p><br><hr><br>';
    }
})->name('tp1-exo2');


$app->get('/tp1/exo3', function () {
    $exo3 = Platform::select('name', 'description')->where('install_base', '>=', '10000000')->get();
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP1-Exo 3<br>
html;
    foreach ($exo3 as $values)
    {
        echo '<h1>' . $values->name . '</h1><br><p>' . $values->description . '</p><br><hr><br>';
    }
})->name('tp1-exo3');

$app->get('/tp1/exo4', function () {
    $exo4 = Game::select('name', 'description')->whereBetween('id', ['21173', '21614'])->get();
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP1-Exo 4<br>
html;
    foreach ($exo4 as $values)
    {
        echo '<h1>' . $values->name . '</h1><br><p>' . $values->description . '</p><br><hr><br>';
    }
})->name('tp1-exo4');

$app->get('/tp1/exo5', function () {
    $start = 0;
    $end = 500;
    $page = 0;
    $prev = 0;
    $next = 1;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $next = $page + 1;
        $prev = $page - 1;
        if ($prev < 0) $prev = 0;
        $start = 0 + 500 * $page;
        $end = 500 + 500 * $page;
    }
    $exo5 = Game::select('name', 'deck')->whereBetween('id', [$start, $end])->get();
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    $url2 = $slim->urlFor('tp1-exo5');
    echo <<<html
<a href='$url1'>Home</a>
TP1-Exo 5: page n°$page<br>
<a href='$url2?page=$prev'>prev</a>
<a href='$url2?page=$next'>next</a>
html;
    foreach ($exo5 as $values)
    {
        echo '<h1>' . $values->name . '</h1><br><p>' . $values->deck . '</p><br><hr><br>';
    }
})->name('tp1-exo5');



$app->get('/tp2/exo1', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    $html = <<<html
<a href='$url1'>Home</a>
TP2-Exo 1<br>
html;

    $games = Game::where('id', '=', '12342')->get();
    foreach ($games as $value) {
        $html .= '<hr>Deck :' . $value->deck . '<br><br>Characters:<br>';
        foreach ($value->characters as $char) {
            $html .= $char->name . '<br>';
        }
    }
    echo $html;
})->name('tp2-exo1');

$app->get('/tp2/exo2', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    $html = <<<html
<a href='$url1'>Home</a>
TP2-Exo 2<br>
html;

    $games = Game::where('name', 'like', 'Mario%')->get();
    foreach ($games as $value) {
        $html .= '<hr>Personnage de ' . $value->name . ' :<br>';
        foreach ($value->characters as $char) {
            $html .= $char->name . '<br>';
        }
    }
    echo $html;
})->name('tp2-exo2');


$app->run();