<?php
    class Solve {

        public $solvable = TRUE;

        function __construct($board){
            //if a cell has one possible number
            if (($cell = $this->possibleNumbers($board)) == null) {
                echo "error in finding possible number";
                $this->solvable = FALSE;
                return;
            }
            if ($cell->setNumber($this->possibleNumber($cell)) == 0){
                echo "error in setting number";
                $this->solvable = FALSE;
                return;
            }
        }

        function possibleNumbers($board){
            foreach ($board->squares as $square){
                foreach ($square->getCells() as $cell){
                    //print the new board to the puzzle json
                    //echo "$cell->numPossibleNumbers<br>";
                    if ($cell->numPossibleNumbers == 1){
                        return $cell;
                    }
                }
            }
            return null;
        }

        function possibleNumber($cell){
            foreach ($cell->possibleNumbers as $num){
                if ($num != 0){
                    return $num;
                }
            }
            return 0;
        }
    }
?>