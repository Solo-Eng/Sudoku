<?php
    require_once('Classes.php');
?>
<?php
    class Board {

        private $squares = array();

        function __construct(){
            //9 squares
            for ($i = 0; $i < 9; $i++){
                $this->squares[$i] = new Square($i + 1);
                $this->squares[$i]->setID($i + 1);
            }
        }

        function getSquares () {
            return $this->squares;
        }

        function getNumberOfEntries (){
            $numCells = 0;
            foreach ($this->squares as $square){
                $numCells += $square->getNumberOfEntries();
            }
            return $numCells;
        }
    }
?>