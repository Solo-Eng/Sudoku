<?php
    require_once('Classes.php');
?>
<?php
    class Board {

        public $squares = array();
        public $index;

        function __construct($i){
            //echo "indexInput: $i<br>";
            if($i == -1) {//9 squares
                for ($j = 0; $j < 9; $j++){
                    $this->squares[$j] = new Square($j + 1);
                    $this->squares[$j]->setID($j + 1);
                }
            }
            else {
                $boardArray = $this->getBoardArray();
                $boardString = $boardArray[$i];
                $this->index = $i;
                for ($j = 0; $j < 9; $j++){
                    $this->squares[$j] = new Square($j + 1);
                    $this->squares[$j]->setID($j + 1);
                }
                $arrayChar = explode(" ", $boardArray[$this->index]);
                $row = 1;
                $col = 1;
                foreach($arrayChar as $char){
                    switch ($char){
                        case 'a':
                            $this->setCellNumber($row, $col, 1);
                            break;
                        case 'b':
                            $this->setCellNumber($row, $col, 2);
                            break;
                        case 'c':
                            $this->setCellNumber($row, $col, 3);
                            break;
                        case 'd':
                            $this->setCellNumber($row, $col, 4);
                            break;
                        case 'e':
                            $this->setCellNumber($row, $col, 5);
                            break;
                        case 'f':
                            $this->setCellNumber($row, $col, 6);
                            break;
                        case 'g':
                            $this->setCellNumber($row, $col, 7);
                            break;
                        case 'h':
                            $this->setCellNumber($row, $col, 8);
                            break;
                        case 'i':
                            $this->setCellNumber($row, $col, 9);
                            break;
                        default:
                            
                    }
                    $col++;
                    if ($col == 10){
                        $col = 1;
                        $row++;
                    }
                    //echo "$row, $col<br>";
                }
            }
        }

        function reconstruct(){
            //9 squares
            for ($i = 0; $i < 9; $i++){
                $this->squares[$i]->reconstruct($i + 1);
                $this->squares[$i]->setID($i + 1);
            }
        }

        function getSquares () {
            return $this->squares;
        }

        function getCells() {
            $cells = array(array());
            $i = 0;
            foreach ($this->squares as $square){
                $i++;
                $j = 0;
                foreach($square->getCells() as $cell){
                    $cells[$i][$j] = $cell;
                    $j++;
                }
            }
            return $cells;
        }

        function getCell($squarenumber, $cellnumber){
            $cell = null;
            foreach ($this->squares as $square){
                $cell = $square->getCell($squarenumber, $cellnumber);
                if ($cell != null){
                    return $cell;
                }
            }
        }

        function returnCellNumberSC($squarenumber, $cellnumber) {
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->square == $squarenumber && $cell->id == $cellnumber){
                        return $cell->number;
                    }
                }
            }
            return 0;
        }

        function returnCellNumberRC($row, $col) {
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->row == $row && $cell->col == $col){
                        return $cell->number;
                    }
                }
            }
            return 0;
        }

        function returnCellCol($squarenumber, $cellnumber){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->square == $squarenumber && $cell->id == $cellnumber){
                        return $cell->col;
                    }
                }
            }
            return 0;
        }

        function returnCellId($squarenumber, $cellnumber){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->square == $squarenumber && $cell->id == $cellnumber){
                        return $cell->id;
                    }
                }
            }
            return 0;
        }

        function returnCellRow($squarenumber, $cellnumber){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->square == $squarenumber && $cell->id == $cellnumber){
                        return $cell->row;
                    }
                }
            }
            return 0;
        }

        function setCellNumber($row, $col, $num){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->row == $row && $cell->col == $col){
                        $cell->setNumber($num);
                        //setting the cell number means we need to remove possible numbers from other relevant cells
                        $this->removePossibleNumber($square, $row, $col, $num);
                        return;
                    }
                }
            }
        }

        function removePossibleNumber ($square, $row, $col, $number){
            //for each square
            foreach ($square->getCells() as $cell){
                $cell->removePossibleNumber($number);
            }
            //for each row
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->row == $row || $cell->col == $col){
                        $cell->removePossibleNumber($number);
                    }
                }
            }

        }

        function getNumberOfEntries (){
            $numCells = 0;
            foreach ($this->squares as $square){
                $numCells += $square->getNumberOfEntries();
            }
            return $numCells;
        }

        function generateNumber($squarenumber, $cellnumber){
            //echo "--<br>";
            $loop = TRUE;

            $cell = $this->getCell($squarenumber, $cellnumber);
                
            for ($i = 1; $i <= 81; $i++){
                $number = rand(1, 9);
                $sum = 0;
                //echo "*$number<br>";
                //go through the possible numbers of 
                foreach($cell->possibleNumbers as $num){
                    //echo "-$num<br>";
                    $sum += $num;
                    if ($num == $number){
                        //echo "Number: $number <br>";
                        //echo "Cell row: $cell->row and column: $cell->col <br>";
                        $loop = FALSE;
                        //break;
                    }
                }
                if ($loop == FALSE || $sum == 0){
                    break;
                }
            }
            if ($loop == TRUE) {
                //echo "r<br>";
                $this->reconstruct();
                return TRUE;
            }

            //echo "-----------------------------Generate Numbers------------------------------------<br>";
            //echo $number . "<br>";
            $this->forEachSquare("find", $squarenumber, $cellnumber, null, null, $number);
            return FALSE;
        }

        function forEachSquare($command, $squarenumber, $cellnumber, $row, $col, $number) {
            //echo "forEachSquare: $command<br>";
            $smallestnum = 10;
            $squaretoreturn = null;
            $celltoreturn = null;
            $sum = 0;
            foreach($this->squares as $square){
                if (($square->id == $squarenumber) && ($command == "find")){
                    //another function
                    $this->forEachCell("find", $square, $cellnumber, null, null, $number);
                }
                else if ($command == "removecell"){
                    $this->forEachCell("removecell", $square, $cellnumber, $row, $col, $number);
                }
                else if ($command == "nexttarget") {
                    [$num, $cellid] = $this->forEachCell("nexttarget", $square, null, null, null, null);
                    if ($num < $smallestnum && $num != 0){
                        $smallestnum = $num;
                        $celltoreturn = $cellid;
                        $squaretoreturn = $square;
                    }
                }
                else if ($command == "possiblenumbers"){
                    $sum += $this->forEachCell("possiblenumbers", $square, null, null, null, null);
                }
            }
            if ($command == "nexttarget"){
                return $returnarr = [$squaretoreturn, $celltoreturn];
            }
            else if ($command == "possiblenumbers"){
                return $sum;
            }
        }

        function forEachCell($command, $square, $cellnumber, $row, $col, $number){
            //echo "forEachCell: $command<br>";
            $smallestnum = 10;
            $celltoreturn = null;
            $sum = 0;
            foreach($square->getCells() as $cell){
                if (($cell->id == $cellnumber) && ($command == "find")){
                    //another function
                    $this->setNewNumber("set", $square, $cell, $cell->row, $cell->col, $number);
                }
                else if ($command == "removesquare"){
                    $cell->removePossibleNumber($number);
                }
                else if ($command == "removecell"){
                    if (($cell->row == $row)||($cell->col == $col)){
                        $cell->removePossibleNumber($number);
                    }
                }
                else if($command == "nexttarget"){
                    $num = $cell->numPossibleNumbers;
                    //echo "numPossibleNumbers: $num for cell: $cell->row, $cell->col<br>";
                    if($num < $smallestnum && $num != 0){
                        $smallestnum = $num;
                        $celltoreturn = $cell;
                    }
                }
                else if ($command == "possiblenumbers"){
                    $sum += $cell->numPossibleNumbers;
                }
            }
            if ($command == "nexttarget"){
                return [$smallestnum, $celltoreturn];
            }
            else if ($command == "possiblenumbers"){
                return $sum;
            }
        }

        function setNewNumber($command, $square, $cell, $row, $col, $number){
            //echo "setNewNumber: $number for cell: $cell->row, $cell->col<br>";
            //chanage the number
            $cell->setNumber($number);
            //and remove the number from the possible numbers
            $cell->removePossibleNumber($number);
            //we also need to remove the possible number from all cells in the row, col, and square
            //starting with square
            $this->forEachCell("removesquare", $square, null, $row, $col, $number);
            //next is row and col
            $this->forEachSquare("removecell", null, null, $row, $col, $number);
        }

        function numPossibleNumbers(){
            return $this->forEachSquare("possiblenumbers", null, null, null, null, null);
        }

        function numPossibleNumberSC($squarenumber, $cellnumber){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $square){
                foreach ($square->getCells() as $cell){
                    if ($cell->square == $squarenumber && $cell->id == $cellnumber){
                        return $cell->numPossibleNumbers;
                    }
                }
            }
            return 0;
        }

        function searchCells($type, $searchnum, $searchnum2, $valnum, $action){
            //go through all of the cells and find the cell with that row and column
            foreach ($this->squares as $squared){
                foreach ($squared->getCells() as $cell){
                    if ($cell->$$type == $searchnum){
                        if($action == "set number"){
                            $cell->setNumber($valnum);
                            //remove possible from other cells in col and row
                            $this->searchCells("row", $cell->row, $valnum, "remove possible number");
                            $this->searchCells("col", $cell->col, $valnum, "remove possible number");
                            $this->searchCells("square", $cell->square, $valnum, "remove possible number");
                            return;
                        }
                        else if ($action == "remove possible number"){
                            $cell->removePossibleNumber($valnum);
                            return;
                        }
                        else if ($action == "set cell square"){
                            searchCells("cell", $searchnum2, null, $valnum, "set number");
                            return;
                        }
                        else if ($action == "get number"){
                            return $cell->number;
                        }
                        return;
                    }
                }
            }
        }

        function toString(){
            $string = "";
            for ($i = 1; $i <= 9; $i++){
                for ($j = 1; $j <= 9; $j++){
                    //starting with 1,1 go column then row until 9,9
                    //search for 1,1
                    $number = $this->returnCellNumberRC($i, $j);
                    switch ($number) {
                        case 1: 
                            $string = $string . "a ";
                            break;
                        case 2: 
                            $string = $string . "b ";
                            break;
                        case 3: 
                            $string = $string . "c ";
                            break;
                        case 4: 
                            $string = $string . "d ";
                            break;
                        case 5: 
                            $string = $string . "e ";
                            break;
                        case 6: 
                            $string = $string . "f ";
                            break;
                        case 7: 
                            $string = $string . "g ";
                            break;
                        case 8: 
                            $string = $string . "h ";
                            break;
                        case 9: 
                            $string = $string . "i ";
                            break;
                        defualt:
                            $string = $string . "0 ";
                    }
                }
            }
            //after getting the string, print to a json file
            $boardArray = $this->getBoardArray();
            //see if the board already exists
            $append = TRUE;
            $count = 0;
            if ($boardArray != null){
                foreach ($boardArray as $boardinstance){
                    if ($boardinstance == $string){
                        $append = FALSE;
                    }
                    $count++;
                }
            }
            if ($append){
                //append board to existing list
                $boardArray[] = $string;
                $this->index = $count;
            }
            //echo "Assigning index: $this->index<br>";
            //reencode it
            $updatedBoards = json_encode($boardArray, JSON_PRETTY_PRINT);
            //print to file
            file_put_contents('boards.json', $updatedBoards);

        }

        function getBoardArray(){
            //get current file
            $boardJson = file_get_contents('boards.json');
            //decode it
            $boardArray = json_decode($boardJson, true);

            return $boardArray;
        }

        function getPuzzleArray(){
            //get current file
            $boardJson = file_get_contents('puzzles.json');
            //decode it
            $boardArray = json_decode($boardJson, true);

            return $boardArray;
        }

        function periodicallyRemove(){

            for ($iterations = 0; $iterations < 65; $iterations++){
                //get string from boards.json
                $boardArray = $this->getBoardArray();
                $puzzleArray = $this->getPuzzleArray();

                //now remove a number and see if it can be solved
                //echo "while1<br>";
                while(1){
                    $row = rand(1, 9);
                    $col = rand(1, 9);
                    $stringIndex = $col * ($row*9 - 1);
                    $arrayChar = explode(" ", $boardArray[$this->index]);
                    if ($arrayChar != 0) {
                        $arrayChar = '0';
                        //found a 0 so breaks
                        break;
                    }
                }
                $offset = $row%3;
                if ($offset == 0) $offset = 3;
                $square = ($row - ($offset-1) + floor(($col-1)/3));
                $base = $col%3;
                if ($base == 0) $base = 3;
                
                $cellid = $base + 3*($offset - 1);
                
                //echo "Periocidally remove: $row, $col, $square, $cellid<br>";
                //echo "temppuzzle<br>";
                $tempPuzzle = new Board($this->index);
                

                $tempPuzzle->forEachSquare("find", $square, $cellid, null, null, 0);
                //update possible numbers for each cell that doesn't have a number
                //echo "UpdateNumber<br>";
                $tempPuzzle->updateAllPossibleNumbers();
                
                //echo "solve<br>";
                //now try to solve it
                $solve = new Solve($tempPuzzle);
                if ($solve->solvable){
                    //echo "here";
                    //update puzzle
                    $this->forEachSquare("find", $square, $cellid, null, null, 0);
                    $this->updateAllPossibleNumbers();
                    //print the new board to the puzzle json
                    $this->toPuzzle();
                }
            }
        }

        function updateAllPossibleNumbers(){
            //if a cell has no number, update it's possible numbers
            foreach($this->squares as $square){
                foreach($square->getCells() as $cell){
                    if ($cell->number == 0){
                        $cell->resetPossibleNumbers();
                        //update it's possible numbers
                        //go through the column, square, and row
                        foreach($this->squares as $squareb){
                            //go thorugh and remove the number from the internal possible numbers
                            foreach ($squareb->getCells() as $cellb){
                                //if any of these are true
                                if (($cellb->row == $cell->row) || ($cellb->col == $cell->col) || ($cellb->square == $cell->square)){
                                    //reset that number
                                    $cell->removePossibleNumber($cellb->number);
                                }
                            }
                        }
                    }
                }
            }
        }

        function toPuzzle(){
            $string = "";
            for ($i = 1; $i <= 9; $i++){
                for ($j = 1; $j <= 9; $j++){
                    //starting with 1,1 go column then row until 9,9
                    //search for 1,1
                    $number = $this->returnCellNumberRC($i, $j);
                    switch ($number) {
                        case 1: 
                            $string = $string . "a ";
                            break;
                        case 2: 
                            $string = $string . "b ";
                            break;
                        case 3: 
                            $string = $string . "c ";
                            break;
                        case 4: 
                            $string = $string . "d ";
                            break;
                        case 5: 
                            $string = $string . "e ";
                            break;
                        case 6: 
                            $string = $string . "f ";
                            break;
                        case 7: 
                            $string = $string . "g ";
                            break;
                        case 8: 
                            $string = $string . "h ";
                            break;
                        case 9: 
                            $string = $string . "i ";
                            break;
                        case 0:
                            $string = $string . "0 ";
                            break;
                        default:
                            break;
                    }
                }
            }
            //after getting the string, print to a json file
            $boardArray = $this->getPuzzleArray();

            $boardArray[$this->index] = $string;

            //reencode it
            $updatedBoards = json_encode($boardArray, JSON_PRETTY_PRINT);
            //print to file
            file_put_contents('puzzles.json', $updatedBoards);
        }
    }
?>