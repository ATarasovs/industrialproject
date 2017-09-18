$(document).ready(function() {
    initButtons();
});

function initButtons() {
    $( "#searchBtn" ).click(function() {
        var saleId = $("#filterBySaleId").val();
        var date = $("#filterByDate").val();
        var time = $("#filterByTime").val();
        var retailerName = $("#filterByRetailerName").val();
        var outletName = $("#filterByOutletName").val();
        var userId = $("#filterByUserId").val();
        var transactionType = $("#filterByTransactionType").val();
        
        
        location.href = salesListReqUrl + "&saleid=" + saleId + "&date=" + date + "&time=" + time + "&retailer=" + retailerName + "&outlet=" + outletName + "&userid=" + userId + "&transactiontype=" + transactionType;
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




