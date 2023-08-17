<?php
    require_once('Classes.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            $board = new Board();
            //echo $board->getNumberOfEntries();
            $squares = array();
            $cells = array(array());
            $i = 0;
            foreach ($board->getSquares() as $square){
                $squares[$i] = $square;
                $i++;
                //echo $square->getNumberOfEntries();
                $j = 0;
                foreach($square->getCells() as $cell){
                    $cells[$i][$j] = $cell;
                    $j++;
                    echo $cell->getCol();
                    if(($j)%3 == 0){
                        echo "<br>";
                    }
                }
            }
        ?>
    </body>
</html>