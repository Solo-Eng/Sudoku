<?php
    class Cell{
        public $number = 0;
        public $possibleNumbers = array();
        public $numPossibleNumbers = 0;
        public $id;
        public $row;
        public $col;
        public $square;

        function __construct($square, $cell){
            for ($i = 0; $i < 9; $i++){
                $this->possibleNumbers[$i] = $i + 1;
                $this->row = ceil($cell/3) + 3*(ceil($square/3) - 1);
                $base = $cell%3;
                if ($base == 0){
                    $base = 3;
                }
                $offset = $square%3 - 1;
                if ($offset == -1){
                    $offset = 2;
                }
                $this->col = 3*$offset + $base;
            }
            $this->getNumberPossibleNumbers();
            $this->id = $cell;
            $this->square = $square;
        }

        function reconstruct($square, $cell){
            for ($i = 0; $i < 9; $i++){
                $this->possibleNumbers[$i] = $i + 1;
                $this->row = ceil($cell/3) + 3*(ceil($square/3) - 1);
                $base = $cell%3;
                if ($base == 0){
                    $base = 3;
                }
                $offset = $square%3 - 1;
                if ($offset == -1){
                    $offset = 2;
                }
                $this->col = 3*$offset + $base;
            }
            $this->getNumberPossibleNumbers();
            $this->id = $cell;
            $this->square = $square;
            $this->number = 0;
        }

        function setNumber ($number) {
            //echo "Set Number $number<br>";
            $this->number = $number;
            for ($i = 1; $i <= 9; $i++){
                $this->removePossibleNumber($i);
            }
            return 1;
        }

        function removePossibleNumber ($number) {
            //echo "Remove Possible Number $number<br>";
            $this->possibleNumbers[$number - 1] = 0;
            //update the count
            $this->getNumberPossibleNumbers();
        }

        function resetPossibleNumbers () {
            //set the number
            $this->possibleNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        }

        function getNumberPossibleNumbers(){
            $count = 0;
            foreach ($this->possibleNumbers as $num){
                if ($num != 0){
                    $count = $count+1;
                }
            }
            $this->numPossibleNumbers = $count;
        }

        function setID ($id){
            $this->id = $id;
        }

        function getID (){
            return $this->id;
        }

        function getRow(){
            return $this->row;
        }

        function getCol(){
            return $this->col;
        }

        function getNumberOfEntries(){
            return 1;
        }
    }
?>