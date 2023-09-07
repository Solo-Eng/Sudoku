//this file is to add the grid lines to the board to make it easier to distiguish
//the different squares

//there should be a grid on the outside of the board and every three squares

//it should go thorugh all of the cells and determine what class(es) should be added

setBorders();

function setBorders(){
    var top = document.querySelectorAll(".row1");
    var left = document.querySelectorAll(".col1");
    var right = document.querySelectorAll(".col9");
    var bottom = document.querySelectorAll(".row9");

    console.log(top);
    top.forEach(function(top) {
        console.log("top");
        top.classList.add("top");
    });
    left.forEach(function(left) {
        console.log("left");
        left.classList.add("left");
    });
    right.forEach(function(right) {
        console.log("right");
        right.classList.add("right");
    });
    bottom.forEach(function(bottom) {
        console.log("bottom");
        bottom.classList.add("bottom");
    });
}

