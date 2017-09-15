$(document).ready(function() {
    $( "#users" ).DataTable( {
        "pagingType": "full_numbers"
    } );
    initButtons();
//    pagination();
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
    
//    $( ".deleteBtn" ).click(function() {
//        var userId = $(this).parent().siblings('.id').text();
//        console.log(userId);
//        
//        location.href = userDeleteReqUrl + "&id=" + userId;
//    });
}

//function pagination() {
//    $( "#users" ).DataTable( {
//        "pagingType": "full_numbers"
//    } );
//}




