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
        location.href = usersManageListReqUrl + "&userid=" + userId + "&username=" + userName;
    });
}

function addContent() {
        
}

function filters() {
   
}

