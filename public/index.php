<?php

session_start();

use library\Url;
use library\HttpException;
use library\Redirect;
use library\Config;
use library\Cookie;
use library\Session;
use library\Db;

require_once '../core/config.php';

// автозагрузка классов
spl_autoload_register(function ($className){
    $fileName = '../core/'.str_replace('\\', '/', $className).'.class.php';
    if(!file_exists($fileName)){
        throw new Exception('Class ['.$className.'] not found!');
        
        // printf('File not found: ['.$fileName.']<br> <br>' . 'Class not found: ['.$className.'] <br> <br>');
        // exit();
    }
    // else{
    //     printf('File require: ['.$fileName.']<br> <br>' . 'Class require: ['.$className.'] <br> <br>');
    // }
    require_once $fileName; 
});



// http://satisfy.news/$controllerName/$actionName

$controllerName = Url::getSegment(0);
$actionName = Url::getSegment(1);


// Идет проверка из url есть ли контроллер,
// то есть, если не указан контроллер то загружается дефолтный контроллер 
// Если указан то загружается другой контроллер  

if (is_null($controllerName)) {
    $controller = 'controllers\ControllerMain';
}else {
    $controller = 'controllers\Controller'.ucfirst($controllerName);
}



if (is_null($actionName)) {
    $action = 'actionIndex';
}else {
    $action = 'action'.ucfirst($actionName);
}

try {

    // здесь проверяется на существования того или иного controller-а и action

    $fileName = '../core/'.str_replace('\\', '/', $controller).'.class.php';
    if(!file_exists($fileName)){
        throw new HttpException('Not found', '404');
    }
    $controller = new $controller();

    if (!method_exists($controller, $action)) {
        throw new HttpException('Not found', '404');
    }

    $controller->$action();

}catch (HttpException $e){
    // header("HTTP/1.1 ".$e->getCode()." ".$e->getMessage());
    // die('Page not found');

    Redirect::to(404);

} catch (\Exception $e) {
    die($e->getMessage());
}




/*

Проверяет авторизован ли пользователь

Если есть куки файлы у польователя, но нету сесионных кук файлов
то тогда мы берём его куки файлы и проверяем эти куки файлы в базе данных


*/

if (Cookie::exists(Config::get('remember.cookieName')) && !Session::exists(Config::get('session.sessionName'))) {
    $hash = Cookie::get(Config::get('remember.cookieName'));
    $hashCheck = Db::getInstance()->get('users_session', array('hash', '=', $hash));

    if ($hashCheck->count()) {
        $hashCheck->first()->user_id;
        $user = new \models\User($hashCheck->first()->user_id);
        $user->login();
    }
}



function debug($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

?>