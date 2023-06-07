<?php
class Table{
    private $gridSize;
    private $topValues;
    private $rightValues;
    private $bottomValues;
    private $leftValues;
    private $myGridValues;
    private $resetGrid;

    public function __construct($sideValues){
        $this->gridSize = 4;
        $this->setSideValues($sideValues);
        $this->initializeTable();
    }
    private function setSideValues($sideValues){
        $chunkedArray = str_split($sideValues, 4);
        $this->topValues = str_split($chunkedArray[0]);
        $this->rightValues = str_split($chunkedArray[1]);
        $this->bottomValues = str_split($chunkedArray[2]);
        $this->leftValues = str_split($chunkedArray[3]);
    }
    private function initializeTable(){
        // Initialize 2d array
        for ($i = 0; $i < $this->gridSize; $i++) {
            $this->myGridValues[$i] = array();
            for ($j = 0; $j < $this->gridSize; $j++) {
                $this->myGridValues[$i][$j] = 1;
                $this->resetGrid[$i][$j] = 1;
            }
        }
    }

    private function isValidTop():bool{
        for($col = 0;$col < $this->gridSize; $col++){
            $min = -1;
            $count = 0;
            for($row = 0;$row < $this->gridSize; $row++){
                if($min < $this->myGridValues[$row][$col]){
                    $min = $this->myGridValues[$row][$col];
                    $count++;
                }
            }
            if($count != $this->topValues[$col]){
                return false;
            }
        }
        return true;
    }

    private function isValidRight():bool{
        for($row = 0;$row < $this->gridSize; $row++){
            $min = -1;
            $count = 0;
            foreach(array_reverse($this->myGridValues[$row]) as $val){
                if($min < $val){
                    $min = $val;
                    $count++;
                }
            }
            if($count != $this->rightValues[$row]){
                return false;
            }
        }
        return true;
    }

    private function isValidBottom():bool{
        for($col = 0;$col < $this->gridSize; $col++){
            $min = -1;
            $count = 0;
            for($row = $this->gridSize - 1; $row >= 0; $row--){
                if($min < $this->myGridValues[$row][$col]){
                    $min = $this->myGridValues[$row][$col];
                    $count++;
                }
            }
            if($count != $this->bottomValues[$col]){
                return false;
            }
        }
        return true;
    }
    
    private function isValidLeft():bool{
        for($row = 0;$row < $this->gridSize; $row++){
            $min = -1;
            $count = 0;
            foreach($this->myGridValues[$row] as $val){
                if($min < $val){
                    $min = $val;
                    $count++;
                }
            }
            if($count != $this->leftValues[$row]){
                return false;
            }
        }
        return true;
    }

    private function numberExistsInRow($row, $numVal){
        for($col = 0; $col < $this->gridSize; $col++){
            if($numVal == $this->myGridValues[$row][$col]){
                return true;
            }
        }
        return false;
    }
    
    private function numberExistsInCol($col, $numVal){
        for($row = 0; $row < $this->gridSize; $row++){
            if($numVal == $this->myGridValues[$row][$col]){
                return true;
            }
        }
        return false;
    }

    private function hasDupes():bool{
        // check dupes in row
        for ($row = 0; $row < $this->gridSize; $row++) {
            if(count($this->myGridValues[$row]) != count(array_unique($this->myGridValues[$row]))){
                return true;
            }
        }
        // check dupes in column
        for ($col = 0; $col < $this->gridSize; $col++) {
            $array = [];
            for ($row = 0; $row < $this->gridSize; $row++) {
                $array[] = $this->myGridValues[$col][$row];
            }
            if(count($array) != count(array_unique($array))){
                return true;
            }
        }
        return false;
    }
    public function getSolution(){
        while($this->hasDupes() or !$this->isValidTop() or !$this->isValidRight() or !$this->isValidBottom() or !$this->isValidLeft()){
            $this->myGridValues = $this->resetGrid;
            for ($row = 0; $row < $this->gridSize; $row++) {
                for ($col = 0; $col < $this->gridSize; $col++) {
                    $tempNum = rand(2,$this->gridSize);
                    if(!$this->numberExistsInCol($col,$tempNum) and !$this->numberExistsInRow($row,$tempNum) and
                        $this->myGridValues[$row][$col] == 1){
                        $this->myGridValues[$row][$col] = $tempNum;
                    }
                }
            }
        }
        return $this->myGridValues;
    }
}
?>