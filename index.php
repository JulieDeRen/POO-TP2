<?php
session_start();
// require_once __DIR__ .'/library/RequireView.php';
require_once __DIR__ .'/library/RequirePage.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/library/Twig.php'; // attention à majuscule ou minuscule ***
require_once __DIR__.'/library/RenderView.php'; //???**** pourquoi disparu
require_once __DIR__.'/library/Validation.php';
require_once __DIR__.'/library/CheckSession.php';
// if isset du chemin existe explode à la / et nettoryer pour renvoyer un tableau sinon juste /
// le / c'est la racine (la page d'accueil)
//print_r($_SERVER['PATH_INFO']);
//$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
$url = isset($_GET['url']) ? explode('/', ltrim($_GET['url'], '/')) : '/';
// print_r($url);
require_once 'controller/ControllerSession.php';
Require_once 'model/ModelSession.php';
Require_once 'model/ModelPageVisited.php';
$controllerSession = new ControllerSession; // initialiser l'objet à l'extérieur condition
$modelSession = new ModelSession;
$modelPageVisited = new ModelPageVisited;

if($url == '/'){
    require_once 'controller/ControllerHome.php';
    $controller = new ControllerHome;
    echo $controller->index();
}else{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__.'/controller/Controller'.$requestURL.'.php';

    if(file_exists($controllerPath)){
        require_once($controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        if(isset($url[1])){
                $method = $url[1];
                if(isset($url[2])){
                    $value = $url[2];
                    echo $controller->$method($value);
                }else{
                    echo $controller->$method();
                }
               
        }else{
            echo $controller->index();
        }
        
    }else{
        require_once 'controller/ControllerHome.php';
        $controller = new ControllerHome;
        echo $controller->error();
    }

    if(!isset($_SESSION['id'])){
        $_SESSION['id']=session_id(); // cette valeur est unique
        $addresseIP = $controllerSession -> getIPAddress(); // assigner la fonction
        $_SESSION['addresseIP'] = $addresseIP; 
        
        // date_default_timezone_set("America/New_York");
        // Source : https://stackoverflow.com/questions/28071538/how-show-local-time-in-new-york-in-php
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('America/New_York'));
        $formatDate = $date->format('Y-m-d');
        $_SESSION['date'] = $formatDate;
        
        $controllerSession -> store($_SESSION);
        
        $_SESSION['idSession'] = $_SESSION['id']; 
        $_SESSION['url'] = $controllerSession -> getURL();
        // print_r($array_url);
        // die();
        $pageVisited = $modelPageVisited->insertSessionPage($_SESSION);
    
    }
    // session_destroy();
}

?>