$(document).ready(function() {
    console.log("Connected");
    initButtons();
    addContent();
});

function initButtons() {
    $( "#search" ).click(function() {
        var userId = $("#filterByUserId").val();
        var userName = $("#filterByUserName").val();
        console.log(userId);
        console.log(userName);
    });
}

function addContent() {
        
}

function filters() {
   
}

