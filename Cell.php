<?php
    class Cell{
        private $number;
        private $possibleNumbers = array();
        public $id;
        public $row;
        public $col;

        function __construct($square, $cell){
            for ($i = 0; $i < 9; $i++){
                $this->possibleNumbers[$i] = $i + 1;
                $this->row = ceil($cell/3) + 3*(ceil($square/3) - 1);
                $this->col = ceil($cell/(floor($this->row/3)+1));
            }
            $this->id = $cell;
        }

        function set_number ($number) {
            $this->number = $number;
        }

        function removePossibleNumber ($number) {
            $this->possibleNumbers[$number - 1] = 0;
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