function cellClicked(row, col, square){
    //highlight all cells with the classes of the same r,c,s
    //reset all the cells
    resetCells();
    //now we can add the new classes to the relevent cells
    addClassToRows(row);
    addClassToCols(col);
    addClassToSquare(square);
    addClassToCell(row, col);
    //now the styles can style them
}

function resetCells(){
    var allCells = document.querySelectorAll(".sudoku-grid-item");

    allCells.forEach(function(allCells) {
        // Perform operations on each element
        allCells.classList.remove("clickedcell");
        allCells.classList.remove("clickedrow");
        allCells.classList.remove("clickedcol");
        allCells.classList.remove("clickedsquare");
    });
}

function addClassToRows(row){
    
    var allRows = document.querySelectorAll(".row" + row);
    allRows.forEach(function(allRows) {
        // Perform operations on each element
        allRows.classList.add("clickedrow");
    });
}

function addClassToCols(col){
    var allCols = document.querySelectorAll(".col" + col);

    allCols.forEach(function(allCols) {
        // Perform operations on each element
        allCols.classList.add("clickedcol");
    });
}

function addClassToSquare(square){
    var allSquares = document.querySelectorAll(".square" + square);

    allSquares.forEach(function(allSquares) {
        // Perform operations on each element
        allSquares.classList.add("clickedsquare");
    });
}

function addClassToCell(row, col){
    var cell = document.querySelectorAll(".row" + row);

    cell.forEach(function(cell) {
        // Perform operations on each element
        if(cell.classList.contains("col" + col)){
            cell.classList.add("clickedcell");
        }
    });
}

function buttonClicked(num){
    var cell = document.querySelector(".clickedcell");
    var row, col;
    if (!cell.classList.contains("notes")){
        cell.innerHTML = num;
        for(var i = 1; i <= 9; i++){
            if(cell.classList.contains("col" + i)){
                console.log(i);
                col = i;
            }
            if(cell.classList.contains("row" + i)){
                row = i;
                console.log(i);
            }
        }
    }
    else {
        if (cell.innerHTML.includes(num)){
            //remove the number
            cell.innerHTML.remove(num);
        }
        else {
            cell.innerHTML += ", " + num;
        }
        for(var i = 1; i <= 9; i++){
            if(cell.classList.contains("col" + i)){
                console.log(i);
                col = i;
            }
            if(cell.classList.contains("row" + i)){
                row = i;
                console.log(i);
            }
        }
    }
    
    //send and add to puzzle board
    // $.ajax({
    //     type: "POST", // Use POST method
    //     url: "Website.php",
    //     data: { row: row,
    //             col: col,
    //             num: num },
    //     success: function(response) {
    //       // This function will be called when the AJAX request succeeds
    //       //console.log("Current Floor: " + response);
    //       //call function to handle response
    //       //indicationImage(response);
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //       // This function will be called if there's an error in the AJAX request
    //       console.error("AJAX request failed: " + textStatus, errorThrown);
    //     }
    // });
}

function switchModes(){
    var cell = document.querySelectorAll(".sudoku-grid-item");

    cell.forEach(function(cell) {
        // Perform operations on each element
        if(cell.classList.contains("notes")){
            cell.classList.remove("notes");
        }
        else{
            cell.classList.add("notes");
        }
    });
}