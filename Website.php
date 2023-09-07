<?php
    require_once('Classes.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="grid.css">
        <script type="text/javascript" src="Button.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <?php
            $board = new Board(-1);

            $reconstruct = TRUE;
            while($reconstruct == TRUE){
                //echo "----------------------------------------------------------------------------------------------<br>";
                $reconstruct = FALSE;
                for ($i = 1; $i <= 9; $i++){
                    for ($j = 1; $j <= 9; $j++){
                        $reconstruct = $board->generateNumber($i, $j);
                        if ($reconstruct){
                            break;
                        }
                    }
                    if ($reconstruct){
                        break;
                    }
                }
            }
            //echo "tostring<br>";
            $board->toString();
            //echo "newboard<br>";
            $puzzle = new Board($board->index);
            //echo "topuzzle<br>";
            $puzzle->toPuzzle();
            //echo "periodicallyremove<br>";
            $puzzle->periodicallyRemove();
        ?>
        <div class="grid-container">
            <div class="grid-item"></div>
                <div class="grid-item">
                    <button class="numInput" onclick="buttonClicked(' ')">Clear</button>
                    <?php
                        for($i = 0; $i < 9; $i++){
                            ?>
                                <button class = "numInput" onclick="buttonClicked(<?php echo $i + 1 ?>)"><?php echo $i + 1 ?></button>
                            <?php
                        }
                    ?>
                    <button class="numInput" onclick="switchModes()">Notes</button>
                </div>
                <div class="grid-item"></div>
                <div class="grid-item"></div>
                    <div class="sudoku-grid-container">
                        <?php
                            for ($k = 1; $k <= 9; $k++){
                                for ($i = 1; $i <= 3; $i++){
                                    for ($j = 1; $j <= 3; $j++){
                                ?>
                                        <div class="sudoku-grid-item row<?php echo $k ?> col<?php echo $j + 3*($i-1)?> square<?php 
                                                $square = 3*(ceil($k/3)-1) + $i; 
                                                echo $square ?> 
                                                <?php 
                                                    $col = $j + 3*($i-1);
                                                    $row = $k;
                                                    switch ($col){
                                                        case 1:
                                                        case 4:
                                                        case 7:
                                                            echo "left ";
                                                            break;
                                                        case 3:
                                                        case 6:
                                                        case 9:
                                                            echo "right ";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    switch ($row){
                                                        case 1:
                                                        case 4:
                                                        case 7:
                                                            echo "top ";
                                                            break;
                                                        case 3:
                                                        case 6:
                                                        case 9:
                                                            echo "bottom ";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                ?>" 
                                                onclick="return cellClicked(<?php echo $k ?>, <?php echo $j + 3*($i-1)?>, <?php echo $square ?>)">
                                            <?php
                                                $a = $k%3;
                                                if($a == 0){
                                                    $a = 3;
                                                }
                                                $cell = 3*($a-1) + $j;
                                                //echo "$row, $col<br>";
                                                $value = $puzzle->returnCellNumberSC($square, $cell);
                                                if ($value != 0){
                                                    echo $value;
                                                }
                                                else echo " ";
                                                
                                            ?>
                                        </div>
                                <?php
                                    }
                                }
                            }
                        ?>
                        <script type="text/javascript" src="Grid.js"></script>
                    </div>
                </div>
                <div class="grid-item"></div>

                <div class="grid-item"></div>
                <div class="grid-item">
                    <div class="sudoku-grid-container">
                        <?php
                            for ($k = 1; $k <= 9; $k++){
                                for ($i = 1; $i <= 3; $i++){
                                    for ($j = 1; $j <= 3; $j++){
                                ?>
                                        <div class="sudoku-grid-item">
                                            <?php
                                                $square = 3*(ceil($k/3)-1) + $i;

                                                $a = $k%3;
                                                if($a == 0){
                                                    $a = 3;
                                                }
                                                $cell = 3*($a-1) + $j;
                                                //echo "$row, $col<br>";
                                                echo $puzzle->numPossibleNumberSC($square, $cell);
                                            ?>
                                        </div>
                                <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="grid-item"></div>
            </div>
        </div>
    </body>
</html>
<?php
    // Check if the AJAX request was made using POST method
	if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the current floor
        $puzzle->setCellNumber(1,2,3);
        // Return the updated floor value as a response
        echo $curFlr;
	}	
?>