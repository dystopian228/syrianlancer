$(document).ready(function () {
    add();
    setInterval(function(){add();},1000);
});

function add(){

    $('#messages-content').append("hello<br>");
    
}