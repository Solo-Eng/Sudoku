<?php
    require_once('Classes.php');
?>
<?php
    class Square {

        public $id;
        private $cells = array();

        function __construct($square){
            //create 9 new cells and set their ids
            for ($i = 0; $i < 9; $i++){
                $this->cells[$i] = new Cell($square, $i + 1);
                $this->cells[$i]->setID($i + 1);
            }
        }

        function removeNumberFromCells ($number){
            //remove each cell in the square
            foreach ($this->cells as $cell){
                $this->cell.removePossibleNumber($number);
            }
        }

        function setID($id){
            $this->id = $id;
        }

        function getCells(){
            return $this->cells;
        }

        function getNumberOfEntries(){
            $numCells = 0;
            foreach ($this->cells as $cell){
                $numCells += $cell->getNumberOfEntries();
            }
            return $numCells;
        }

    }
?>