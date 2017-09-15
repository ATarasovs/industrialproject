$(document).ready(function() {
    initButtons();
    
    $pages.appendTo('#users');

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

$('.pageNumber').hover(  function() {
        $(this).addClass('focus');
    },   function() {
        $(this).removeClass('focus');
    } ); 
    $('table').find('tbody tr:has(td)').hide(); 
    var tr = $('table tbody tr:has(td)'); 
    for (var i = 0; i & lt; = recordPerPage - 1; i++) {   
        $(tr[i]).show(); 
    } 
    $('span').click(function(event) {  
        $('#tblData').find('tbody tr:has(td)').hide();  
        var nBegin = ($(this).text() - 1) * recordPerPage;  
        var nEnd = $(this).text() * recordPerPage - 1;  
        for (var i = nBegin; i & lt; = nEnd; i++)   {   
            $(tr[i]).show();  
        } 
    });




