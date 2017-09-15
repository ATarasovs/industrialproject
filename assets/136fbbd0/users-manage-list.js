$(document).ready(function() {
    initButtons();
    
    $('td', 'table').each(function(i) {
//        $(this).text(i+1);
    });



$('table#users').each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});

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




