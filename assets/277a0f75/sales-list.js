$(document).ready(function() {
    var saleIdParam = getParameterByName('saleid');
    var dateParam = getParameterByName('date');
    var timeParam = getParameterByName('time');
    var retailerNameParam = getParameterByName('retailer');
    var outletNameParam = getParameterByName('outlet');
    var userIdParam = getParameterByName('userid');
    var transactionTypeParam = getParameterByName('transactiontype');
    
    $("#filterBySaleId").val(saleIdParam);
    $("#filterByDate").val(dateParam);
    $("#filterByTime").val(timeParam);
    $("#filterByRetailerName").val(retailerNameParam);
    $("#filterByOutletName").val(outletNameParam);
    $("#filterByUserId").val(userIdParam);
    $("#filterByTransactionType").val(transactionTypeParam);
    
    initButtons();
    initKeyPress();
});

function initButtons() {
    $( "#searchBtn" ).click(function() {
        search();
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

function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

function keyPress() {
    $('.filterInput').keypress(function(e){
        if(e.which == 13){//Enter key pressed
           search();
        }
    });
}

function search() {
    var saleId = $("#filterBySaleId").val();
        var date = $("#filterByDate").val();
        var time = $("#filterByTime").val();
        var retailerName = $("#filterByRetailerName").val();
        var outletName = $("#filterByOutletName").val();
        var userId = $("#filterByUserId").val();
        var transactionType = $("#filterByTransactionType").val();
        
        
        location.href = salesListReqUrl + "&saleid=" + saleId + "&date=" + date + "&time=" + time + "&retailer=" + retailerName + "&outlet=" + outletName + "&userid=" + userId + "&transactiontype=" + transactionType;
   
}



