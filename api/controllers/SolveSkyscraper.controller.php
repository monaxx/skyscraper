<?php
    include 'inc/classAutoloader.inc.php';
    function solveSkyscraper($sideValues){
        $solution = new Table($sideValues);
        return $solution->getSolution();
    }
?>