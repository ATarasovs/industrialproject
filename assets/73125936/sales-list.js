$(document).ready(function() {
    initButtons();
});

function initButtons() {
    $( "#searchBtn" ).click(function() {
        var saleId = $("#filterBySaleId").val();
        var date = $("#filterbyDate").val();
        var time = $("#filterByTime").val();
        var outletName = $("#filterByOutletName").val();
        location.href = salesListReqUrl + "&saleid=" + saleId + "&date=" + date + "&time=" + time + "&outlet=" + outletName;
    });
    
    $( "#unsetFiltersBtn" ).click(function() {
        location.href = salesListReqUrl;
    });
    
    $( ".viewBtn" ).click(function() {
        var saleId = $(this).parent().siblings('.id').text();
        console.log(saleId);
        location.href = salesViewReqUrl + "&id=" + saleId;
    });
}




