<?php
spl_autoload_register('classAutoLoader');

function classAutoLoader($className){
    $extension = '.class.php';
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(strpos($url, 'inc') != false){
        $path = '../classses/';
    }elseif(strpos($className, 'Controller') != false){
        $path = 'controllers/';
        $extension = '.controller.php';
    }elseif(strpos($className, 'Model') != false){
        $path = 'models/';
        $extension = '.model.php';
    }else{
        $path = 'classes/';
    }
    require_once $path . $className . $extension;
}
?>
