<?php
require_once 'vendor/autoload.php';

use appdb\models\Character;
use appdb\models\Game;
use appdb\models\Company;
use appdb\models\Message;
use appdb\models\Platform;
use appdb\models\User;
use Faker\Factory;
use \Illuminate\Database\Capsule\Manager as DB;
use Slim\Slim;
use appdb\models\Genre;

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
    $url8 = $slim->urlFor('tp2-exo3');
    $url9 = $slim->urlFor('tp2-exo4');
    $url10 = $slim->urlFor('tp2-exo5');
    $url11 = $slim->urlFor('tp2-exo6');
    $url12 = $slim->urlFor('tp2-exo7');

    $url13 = $slim->urlFor('tp3-exo1');
    $url14 = $slim->urlFor('tp3-exo2');
    $url15 = $slim->urlFor('tp3-exo3');
    $url16 = $slim->urlFor('tp3-exo4');

    $url17 = $slim->urlFor('tp3-p2-exo1');
    $url18 = $slim->urlFor('tp3-p2-exo2');
    $url19 = $slim->urlFor('tp3-p2-exo3');
    $url20 = $slim->urlFor('tp3-p2-exo4');

    $url21 = $slim->urlFor('tp4-exo1');
    $url22 = $slim->urlFor('tp4-exo2');
    echo <<<html
<div>
    <h1>TP 1:</h1>
    <a href='$url1'>Exo1</a>
    <a href='$url2'>Exo2</a>
    <a href='$url3'>Exo3</a>
    <a href='$url4'>Exo4</a>
    <a href='$url5'>Exo5</a>
</div>
<hr>
<div>
    <h1>TP 2:</h1>
    <a href='$url6'>Exo1</a>
    <a href='$url7'>Exo2</a>
    <a href='$url8'>Exo3</a>
    <a href='$url9'>Exo4</a>
    <a href='$url10'>Exo5</a>
    <a href='$url11'>Exo6</a>
    <a href='$url12'>Exo7</a>
</div>
<hr>
<div>
    <h1>TP 3 Partie 1:</h1>
    <a href='$url13'>Exo1</a>
    <a href='$url14'>Exo2</a>
    <a href='$url15'>Exo3</a>
    <a href='$url16'>Exo4</a>
</div>
<hr>
<div>
    <h1>TP 3 Partie 2:</h1>
    <a href='$url17'>Exo1</a>
    <a href='$url18'>Exo2</a>
    <a href='$url19'>Exo3</a>
    <a href='$url20'>Exo4</a>
</div>
<hr>
<div>
    <h1>TP 4:</h1>
    <a href='$url21'>Exo1</a>
    <a href='$url22'>Exo2</a>
</div>
<hr>
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

$app->get('/tp2/exo3', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    $html = <<<html
<a href='$url1'>Home</a>
TP2-Exo 3<br>
html;

    $companies = Company::where('name', 'like', '%Sony%')->get();
    foreach ($companies as $value) {
        $html .= '<hr>Jeux de ' . $value->name . ' :<br>';
        foreach ($value->gameDevelops as $game) {
            $html .= $game->name . '<br>';
        }
    }
    echo $html;
})->name('tp2-exo3');

$app->get('/tp2/exo4', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP2-Exo 4<br>
html;

    foreach (Game::where('name', 'like', 'Mario%')->get() as $game) {
        echo '<h3>'. $game->name . ' : ' . $game->id . "</h3><ul>";
        foreach ($game->original_game_ratings as $rating) {
            echo '<li>'. $rating->name . ' ('. $rating->rating_board->name . ")</li>";
        }
        echo "</ul>";
    }
})->name('tp2-exo4');

$app->get('/tp2/exo5', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP2-Exo 5<br>
html;

    foreach (Game::where('name', 'like', 'Mario%')->has('characters', '>', 3)->get() as $game) {
        echo '<h3>' . $game->name . ' : ' . $game->id . "<h3><ul>";
        foreach ($game->characters as $ch) {
            echo '<li>'.$ch->id . '. ' . $ch->name . ' : '.$ch->deck . "</li>" ;
        }
        echo "</ul>";
    }
})->name('tp2-exo5');

$app->get('/tp2/exo6', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP2-Exo 6<br>
html;

    foreach (Game::where('name', 'like', 'Mario%')
                 ->whereHas('original_game_ratings', function($q){
                     $q->where('name', 'like', '%3+%');
                 })

                 ->get() as $game)  {
        echo '<h3>'. $game->name . ' : ' . $game->id . "<h3><ul><li><ul>";
        foreach ($game->original_game_ratings as $rating) {
            echo '<li>'. $rating->name .  "</li>";
        }
        echo '</ul></li><li><ul>';
        foreach ($game->publishers as $comp) {
            echo '<li>'. $comp->name .  "</li>";
        }
        echo '</ul></li></ul>';
    }
})->name('tp2-exo6');


$app->get('/tp2/exo7', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP2-Exo 7<br>
html;

    $genre = new Genre();
    $genre->name = 'OwO';
    $genre->deck = 'OwO Deck';
    $genre->description = 'OwO Description';
    $genre->save();

    foreach (Game::whereIn('id', array(12, 56, 345))->get() as $game) {
        $game->genres()->attach($genre);
    }


    foreach (Game::whereIn('id', array(12, 56, 345))->get() as $game) {
        echo "<h3>$game->name</h3><ul>";
        foreach ($game->genres as $genre) {
            echo "<li>$genre->name</li>";
        }
        echo "</ul>";
    }

})->name('tp2-exo7');


$app->get('/tp3/exo1', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-Exo 1<br>
html;

    $time_start = microtime_float();

    $games = Game::select('name', 'description')->get();

    $time_end = microtime_float();
    $time = $time_end - $time_start;

    echo "temps d'execution: $time seconde<br>";
})->name('tp3-exo1');

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$app->get('/tp3/exo2', function () {
    $time_start = microtime_float();

    $exo1 = Game::select('name', 'description')->where('name', 'like', '%mario%')->get();

    $time_end = microtime_float();
    $time = $time_end - $time_start;

    echo "temps d'execution: $time seconde<br>";
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-Exo 2<br>
html;
})->name('tp3-exo2');

$app->get('/tp3/exo3', function () {
    $time_start = microtime_float();

    $exo1 = Game::select('name', 'description')->where('name', 'like', 'mario%')->get();

    $time_end = microtime_float();
    $time = $time_end - $time_start;

    echo "temps d'execution: $time seconde<br>";
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-Exo 3<br>
html;
})->name('tp3-exo3');


$app->get('/tp3/exo4', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-Exo 4<br>
html;

    $time_start = microtime_float();

    foreach (Game::where('name', 'like', 'Mario%')
                 ->whereHas('original_game_ratings', function($q){
                     $q->where('name', 'like', '%3+%');
                 })->get() as $game)  {
        foreach ($game->original_game_ratings as $rating) {
        }
        foreach ($game->publishers as $comp) {
        }
    }

    $time_end = microtime_float();
    $time = $time_end - $time_start;
    echo "temps d'execution: $time seconde<br>";

})->name('tp3-exo4');



$app->get('/tp3/p2/exo1', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 1<br>
html;
    DB::enableQueryLog();
    $exo1 = Game::select('name', 'description')->where('name', 'like', '%mario%')->get();
    dd(DB::getQueryLog());
})->name('tp3-p2-exo1');



$app->get('/tp3/p2/exo2', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 2<br>
html;
    DB::enableQueryLog();


    Game::select('name')->where('id', '=', '12342')->first()->characters()->get();


    dd(DB::getQueryLog());
})->name('tp3-p2-exo2');



$app->get('/tp3/p2/exo3', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 3<br>
html;
    DB::enableQueryLog();


    foreach (Game::where('name', 'like', '%Mario%')->get() as $game)
    {
        $game->first_appearance_characters()->get();
    }

    dd(DB::getQueryLog());
})->name('tp3-p2-exo3');


$app->get('/tp3/p2/exo4', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 4<br>
html;
    DB::enableQueryLog();



    foreach (Game::select('name')->where('name', 'like', '%Mario%')->get() as $game)
    {
        $game->characters()->get();
    }


    dd(DB::getQueryLog());
})->name('tp3-p2-exo4');



$app->get('/tp3/p2/exo5', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 5<br>
html;
    DB::enableQueryLog();


    foreach (Company::select('name')->where('name', 'like', '%Sony%')->get() as $company)
    {
        $company->gameDevelops()->get();
    }


    dd(DB::getQueryLog());
})->name('tp3-p2-exo5');

$app->get('/tp4/exo1', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 5<br><br>
html;

    $user1 = new User();
    $user1->name = 'Robert';
    $user1->email = 'darksasuke@gmail.com';
    $user1->surname = 'Dupont';
    $user1->adress = 'city';
    $user1->phone = '0394502846';
    $user1->save();

    echo $user1 . "<hr>";

    $user2 = new User();
    $user2->name = 'Gillou';
    $user2->email = 'XxGillouxX@gmail.com';
    $user2->surname = 'Durand';
    $user2->adress = 'othercity';
    $user2->phone = '0344328948';
    $user2->save();

    echo $user2 . "<hr>";

    $mess1 = new Message();
    $mess1->title='une pepite';
    $mess1->content='ce jeu est trop bien';
    $mess1->save();

    $mess2 = new Message();
    $mess2->title='NUL';
    $mess2->content='NUL NUL NUL';
    $mess2->save();


    $mess3 = new Message();
    $mess3->title='TRO BI1';
    $mess3->content='JADOR';
    $mess3->save();

    $mess4 = new Message();
    $mess4->title='je le recommande';
    $mess4->content='c est un bon jeu';
    $mess4->save();

    $mess5 = new Message();
    $mess5->title='j aime pas';
    $mess5->content='parceque j aime pas';
    $mess5->save();

    $mess6 = new Message();
    $mess6->title='bof';
    $mess6->content='rien de fou dans ce jeu';
    $mess6->save();

    $user1->messages()->attach($mess1);
    $user1->messages()->attach($mess2);
    $user1->messages()->attach($mess3);
    $user1->save();

    $user2->messages()->attach($mess4);
    $user2->messages()->attach($mess5);
    $user2->messages()->attach($mess6);
    $user2->save();


    $game = Game::where('id', '=', '12342')->first();
    $game->messages()->attach($mess1);
    $game->messages()->attach($mess2);
    $game->messages()->attach($mess3);
    $game->messages()->attach($mess4);
    $game->messages()->attach($mess5);
    $game->messages()->attach($mess6);
    $game->save();

    echo '<hr>';

    foreach (User::where('id', '=', $user1->id)->first()->messages() as $message)
    {
        echo $message;
    }

    echo '<hr>';

    foreach (User::where('id', '=', $user1->id)->first()->messages() as $message)
    {
        echo $message;
    }

    echo '<hr>';


    foreach (Game::where('id', '=', '12342')->first()->messages() as $message)
    {
        echo $message;
    }

    echo '<hr>';

    echo "Les donnée on bien etais ajouté";


})->name('tp4-exo1');


$app->get('/tp4/exo2', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 5<br><br>
html;
    $faker = Factory::create();
    for ($i=0; $i<25000; $i++) {
        $user=new User();
        $user->name = $faker->firstname;
        $user->email = $faker->email;
        $user->surname = $faker->lastName;
        $user->adress = $faker->address;
        $user->phone = $faker->phoneNumber;
        $user->save();
    }
    for ($j=0; $j<250000; $j++){
        $mess = new Message();
        $mess->title=$faker->word;
        $mess->content=$faker->text(100);
        $mess->save();

        $usr=User::where('id','=', $faker->numberBetween(1,25000))->first();
        $usr->messages()->attach($mess);
        $usr->save();

        $game=Game::where('id','=', $faker->numberBetween(1,47948))->first();
        $game->messages()->attach($mess);
        $game->save();
    }
})->name('tp4-exo2');

$app->get('/tp4/exo3', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    if (isset($_GET['user']))
    {
        $user = $_GET['user'];
    } else {
        $user = 1;
    }
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 5<br>
L'utilisateur se set dans les get situé dans l'url: 
<code>?user=$user</code>
<br><br>
html;

    foreach (User::where('id', '=', $user)->first()->messages()->orderBy('created_at','desc')->get() as $message) {
        echo $message->title . ' | ' . $message->content . ' | ' . $message->created_at . '<hr>';
    }

})->name('tp4-exo3');

$app->get('/tp4/exo4', function () {
    $slim = Slim::getInstance();
    $url1 = $slim->urlFor('home');
    echo <<<html
<a href='$url1'>Home</a>
TP3-P2-Exo 5<br><br>
html;

    foreach(User::has('messages', '>', 5)->get() as $user){
        echo $user->name . '<hr>';
    }

})->name('tp4-exo4');




/* *********************************************** *
 *                      API                        *
 * *********************************************** */

$app->get('/api/games/:id', function ($id) {
    $game = Game::where('id', '=', filter_var($id, FILTER_SANITIZE_STRING))->first();
    if (isset($game->name))
    {
        $id = $game->id;
        $name = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->name)));
        $alias = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->alias)));
        $deck = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->deck)));
        $description = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->description)));
        $original_release_date = $game->original_release_date;
        header('Content-Type: application/json; charset=utf-8');
        echo <<<json
{
    "game": {
        "id": $id,
        "name": "$name",
        "alias": "$alias",
        "deck": "$deck",
        "description": "$description",
        "original_release_date": "$original_release_date"
    },
    "links": {
        "comments": "/api/games/$id/comments",
        "characters": "/api/games/$id/characters"
    }
}
json;
        exit();
    } else {
        header('Content-Type: application/json; charset=utf-8');
        header("HTTP/1.0 404 Not Found");
        echo '{"error": "404 - Not Found"}';
        exit();
    }
})->name('api-game-id');

$app->get('/api/games/:id/comments', function ($id) {
    $game = Game::where('id', '=', filter_var($id, FILTER_SANITIZE_STRING))->first();
    if (isset($game->name))
    {
        $json = '{"comments": [';
        $json_tmp = '';

        $comments = $game->messages;

        foreach ($comments as $comment)
        {
            $id = $comment->id;
            $user = User::whereHas('messages', function($q) use ($id) {
                $q->where('id', '=', $id);
            })->first()->name;
            $title = $comment->title;
            $content = $comment->content;
            $created_at = $comment->created_at;
            $json_tmp .= <<<json
{"user": "$user", "title": "$title", "content": "$content", "created_at": "$created_at"},
json;
        }
        if ($json_tmp != '')
        {
            $json .= mb_substr($json_tmp, 0, -1);
        }
        header('Content-Type: application/json; charset=utf-8');
        echo $json . ']}';
        exit();

    } else {
        header('Content-Type: application/json; charset=utf-8');
        header("HTTP/1.0 404 Not Found");
        echo '{"error": "404 - Not Found"}';
        exit();
    }
})->name('api-game-id-comments');


$app->post('/api/games/:id/comments', function ($id) {
    $game = Game::where('id', '=', filter_var($id, FILTER_SANITIZE_STRING))->first();
    if (isset($game->name))
    {
        if (isset($_POST['json']))
        {
            try {
                $json = json_decode($_POST['json']);

                $mess = new Message();
                $mess->title = filter_var($json->title, FILTER_SANITIZE_STRING);
                $mess->content = filter_var($json->content, FILTER_SANITIZE_STRING);
                $mess->save();

                $usr=User::where('email','=', $json->email)->first();
                $usr->messages()->attach($mess);
                $usr->save();

                $game->messages()->attach($mess);
                $game->save();

                $id = $mess->id;
                $title = $mess->title;
                $content = $mess->content;

                header('Content-Type: application/json; charset=utf-8');
                header("HTTP/1.0 201 Create");
                echo <<<json
{"message": {"id": $id, "title": "$title", "content": "$content"}, "links": {"self": "/api/comments/$id"}}
json;
                exit();
            } catch (Exception $e) {
                header('Content-Type: application/json; charset=utf-8');
                header("HTTP/1.0 400 Bad Request");
                echo '{"error": "400 - Bad Request"}';
                exit();
            }
        } else {
            header('Content-Type: application/json; charset=utf-8');
            header("HTTP/1.0 400 Bad Request");
            echo '{"error": "400 - Bad Request"}';
            exit();
        }
    } else {
        header('Content-Type: application/json; charset=utf-8');
        header("HTTP/1.0 404 Not Found");
        echo '{"error": "404 - Not Found"}';
        exit();
    }
})->name('api-game-id-comments');




$app->get('/api/games/:id/characters', function ($id) {
    $game = Game::where('id', '=', filter_var($id, FILTER_SANITIZE_STRING))->first();
    if (isset($game->name))
    {
        $json = '{"characters": [';
        $json_tmp = '';

        $characters = $game->characters;

        foreach ($characters as $character)
        {
            $id = $character->id;
            $name = $character->name;
            $json_tmp .= <<<json
{"character": {"id": $id, "name": "$name"}, "links": {"self": "/api/characters/$id"}},
json;
        }
        if ($json_tmp != '')
        {
            $json .= mb_substr($json_tmp, 0, -1);
        }
        header('Content-Type: application/json; charset=utf-8');
        echo $json . ']}';
        exit();

    } else {
        header('Content-Type: application/json; charset=utf-8');
        header("HTTP/1.0 404 Not Found");
        echo '{"error": "404 - Not Found"}';
        exit();
    }
})->name('api-game-id-characters');


$app->get('/api/games', function () {
    if (isset($_GET['page']))
    {
        $pos = $_GET['page'] * 200;
        if ($_GET['page'] - 1 > 0) {
            $prev = $_GET['page'] - 1;
        } else {
            $prev = 0;
        }
        $next = $_GET['page'] + 1;
    } else {
        $pos = 0;
        $prev = 0;
        $next = 1;
    }
    $json = '{"games": [';
    $json_tmp = '';
    foreach (Game::whereBetween('id', [$pos, $pos + 200])->get() as $game)
    {
        $id = $game->id;
        $name = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->name)));
        $alias = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->alias)));
        $deck = trim(preg_replace('/\s+/', ' ', str_replace('"', '\"', $game->deck)));
        $json_tmp .= <<<json
{"game": {"id": $id, "name": "$name", "alias": "$alias", "deck": "$deck"}, "links": {"self": "/api/games/$id"}},
json;
    }
    if ($json_tmp != '')
    {
        $json .= mb_substr($json_tmp, 0, -1);
    }
    $slim = Slim::getInstance();
    $url = $slim->urlFor('api-games') . '?page=';
    header('Content-Type: application/json; charset=utf-8');
    echo $json . '], "links" : {"prev": { "href": "' . $url . $prev .  '" }, "next": { "href": "' . $url . $next . '" }}}';
    exit();
})->name('api-games');






$app->run();