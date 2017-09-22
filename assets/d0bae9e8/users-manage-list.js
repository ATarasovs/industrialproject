$(document).ready(function() {
    
    var userId = getParameterByName('userid');
    var username = getParameterByName('username');
    
    $("#filterByUserId").val(userId);
    $("#filterByUserName").val(username);
    
    initButtons();
    initKeyPress();
});

function initButtons() {
    $( "#searchBtn" ).click(function() {
        var userId = $("#filterByUserId").val();
        var userName = $("#filterByUserName").val();
        location.href = usersManageListReqUrl + "&userid=" + userId + "&username=" + userName;
    });
    
    $( "#unsetFiltersBtn" ).click(function() {
        location.href = usersManageListReqUrl;
    });
    
    $( ".viewBtn" ).click(function() {
        var userId = $(this).parent().siblings('.id').text();
        console.log(userId);
        location.href = userViewReqUrl + "&id=" + userId;
    });
    
    $( ".updateBtn" ).click(function() {
        var userId = $(this).parent().siblings('.id').text();
        console.log(userId);
        location.href = userUpdateReqUrl + "&id=" + userId;
    });
}

function initKeyPress() {
    $('.filterInput').keypress(function(e){
        if(e.which == 13){//Enter key pressed
           search();
        }
    });
}
    
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function search() {
    var userId = $("#filterByUserId").val();
    var userName = $("#filterByUserName").val();
    location.href = usersManageListReqUrl + "&userid=" + userId + "&username=" + userName;
}






