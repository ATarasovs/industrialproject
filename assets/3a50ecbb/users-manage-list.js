$(document).ready(function() {
    console.log("Connected");
    initButtons();
    addContent();
});

function initButtons() {
    $( "#searchBtn" ).click(function() {
        var userId = $("#filterByUserId").val();
        var userName = $("#filterByUserName").val();
        location.href = usersManageListReqUrl + "&userid=" + userId + "&username=" + userName;
    });
    
    $( "#unsetfiltersBtn" ).click(function() {
        location.href = usersManageListReqUrl;;
    });
    
    $( "#viewBtn" ).click(function() {
        location.href = userViewReqUrl;;
    });
}

function addContent() {
        
}

function filters() {
   
}

