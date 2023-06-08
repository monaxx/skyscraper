<?php
    include 'inc/classAutoloader.inc.php';
    function solveSkyscraper($sideValues){
        // Suggestion ni Titi:
        // $table = new Table();
        //
        // Dari mahitabo tong pag create sa 2D array and 
        // pag add adtong mga side values
        // $table->initializeTabe($sideValues);
        //
        // $solution = $table->solveProblem();
        //
        $solution = new Table($sideValues);
        return $solution->getSolution();
    }
?>
