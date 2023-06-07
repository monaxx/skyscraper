<?php
require 'controllers/SolveSkyscraper.controller.php';
require 'controllers/Response.controller.php';

header("content-type:appliction/json");
// $_POST['sideValues'] = '2241123232132123';
if(isset($_POST['sideValues'])){
    $sideValues = $_POST['sideValues'];
    $result = solveSkyscraper($sideValues);
    response("200", "ok!", $result);
}else{
    response("400", "Bad Request!", null);
}
?>