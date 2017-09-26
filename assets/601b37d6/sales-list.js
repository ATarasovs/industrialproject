$(document).ready(function() {
    
    var dateFromParam = getParameterByName('datefrom');
    var dateToParam = getParameterByName('dateto');
    var timeFromParam = getParameterByName('timefrom');
    var timeToParam = getParameterByName('timeto');
    var weekdayFromParam = getParameterByName('weekdayfrom');
    var weekdayToParam = getParameterByName('weekdayto');
    var yearParam = getParameterByName('year');
    var monthParam = getParameterByName('month');
    var retailerNameParam = getParameterByName('retailer');
    var outletNameParam = getParameterByName('outlet');
    var userIdParam = getParameterByName('userid');
    var transactionTypeParam = getParameterByName('transactiontype');
    var totalAmountFromParam = getParameterByName('totalamountfrom');
    var totalAmountToParam = getParameterByName('totalamountto');
    
//    $("#filterBySaleId").val(saleIdParam);
    $("#filterByDateFrom").val(dateFromParam);
    $("#filterByDateTo").val(dateToParam);
    $("#filterByTimeFrom").val(timeFromParam);
    $("#filterByTimeTo").val(timeToParam);
    $("#filterByWeekdayFrom").val(weekdayFromParam);
    $("#filterByWeekdayTo").val(weekdayToParam);
    $("#filterByYear").val(yearParam); 
    $("#filterByMonth").val(monthParam); 
    $("#filterByRetailerName").val(retailerNameParam);
    $("#filterByOutletName").val(outletNameParam);
    $("#filterByUserId").val(userIdParam);
    $("#filterByTransactionType").val(transactionTypeParam);
    $("#filterByTotalAmountFrom").val(totalAmountFromParam);
    $("#filterByTotalAmountTo").val(totalAmountToParam);
    
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
    
    $( "#advancedFiltersBtn" ).click(function() {
        $( "#hidden" ).toggleClass( "hide" );
    });
    
    $( "#createTribeBtn" ).click(function() {
        $( "#createTribe" ).removeClass( "hide" );
    });
    
    $( "#saveTribeBtn" ).click(function() {
        var title = $("#title").val();
        var description = $("#description").val();
        var dateFrom = $("#filterByDateFrom").val();
        var dateTo = $("#filterByDateTo").val();
        var timeFrom = $("#filterByTimeFrom").val();
        var timeTo = $("#filterByTimeTo").val();
        var weekdayFrom = $("#filterByWeekdayFrom").val();
        var weekdayTo = $("#filterByWeekdayTo").val();
        var year = $("#filterByYear").val(); 
        var month = $("#filterByMonth").val();
        var retailerName = $("#filterByRetailerName").val();
        var outletName = $("#filterByOutletName").val();
        var newUserId = $("#filterByUserId").val();
        var transactionType = $("#filterByTransactionType").val();    
        var totalAmountFrom = $("#filterByTotalAmountFrom").val();
        var totalAmountTo = $("#filterByTotalAmountTo").val();
        
//        console.log(title);
//        console.log(description);
        location.href = saveTribeReqUrl + "&title=" + title + "&description=" + description + "&datefrom=" + dateFrom + "&dateto=" + dateTo + "&timefrom=" + timeFrom + "&timeto=" + timeTo + "&weekdayfrom=" + weekdayFrom + "&weekdayto=" + weekdayTo + "&year="+ year +"&month=" + month + "&retailer="  + retailerName + "&outlet=" + outletName + "&newuserid=" + newUserId + "&transactiontype=" + transactionType + "&totalamountfrom=" + totalAmountFrom + "&totalamountto=" + totalAmountTo;
    });
    
    $( "#tribeBtn" ).click(function() {
        var tribeID = $("#tribeBtn").val();
        console.log(tribeID);
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

function initKeyPress() {
    $('.filterInput').keypress(function(e){
        if(e.which == 13){//Enter key pressed
           search();
        }
    });
}

function search() {
//    var saleId = $("#filterBySaleId").val();
    var dateFrom = $("#filterByDateFrom").val();
    var dateTo = $("#filterByDateTo").val();
    var timeFrom = $("#filterByTimeFrom").val();
    var timeTo = $("#filterByTimeTo").val();
    var weekdayFrom = $("#filterByWeekdayFrom").val();
    var weekdayTo = $("#filterByWeekdayTo").val();
    var year = $("#filterByYear").val(); 
    var month = $("#filterByMonth").val();
    var retailerName = $("#filterByRetailerName").val();
    var outletName = $("#filterByOutletName").val();
    var userId = $("#filterByUserId").val();
    var transactionType = $("#filterByTransactionType").val();    
    var totalAmountFrom = $("#filterByTotalAmountFrom").val();
    var totalAmountTo = $("#filterByTotalAmountTo").val();

    location.href = salesListReqUrl + "&datefrom=" + dateFrom + "&dateto=" + dateTo + "&timefrom=" + timeFrom + "&timeto=" + timeTo + "&weekdayfrom=" + weekdayFrom + "&weekdayto=" + weekdayTo + "&year="+ year +"&month=" + month + "&retailer="  + retailerName + "&outlet=" + outletName + "&userid=" + userId + "&transactiontype=" + transactionType + "&totalamountfrom=" + totalAmountFrom + "&totalamountto=" + totalAmountTo;
   
}



