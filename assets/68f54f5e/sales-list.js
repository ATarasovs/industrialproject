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
//    var userIdParam = getParameterByName('userid');
    var transactionTypeParam = getParameterByName('transactiontype');
    var totalAmountFromParam = getParameterByName('totalamountfrom');
    var totalAmountToParam = getParameterByName('totalamountto');
    
    var outletNameParam = "";
    if(getParameterByName('outlet0')!=null && getParameterByName('outlet0')!="") {
        $("#outletnameinfo").removeClass("hide");
        outletNameParam = "<span class='badge badge-primary'>" + getParameterByName('outlet0') + "</span> ";
    }
    
    for (var i=1; i<=13; i++) {
        if(getParameterByName('outlet' + i)!=null) {
            outletNameParam += "<span class='badge badge-primary'>" + getParameterByName('outlet' + i)  + "</span> ";      
        }
    }
    
    var outletsParam = "";
    if(getParameterByName('outlet0')!=null && getParameterByName('outlet0')!="") {
        outletsParam = getParameterByName('outlet0') + ";";
    }
    
    for (var i=1; i<=13; i++) {
        if(getParameterByName('outlet' + i)!=null) {
            outletsParam += getParameterByName('outlet' + i) + ";";      
        }
    }
    
    var selectedOutlet = document.createElement('small');
    selectedOutlet.innerHTML = "" + outletNameParam;
    document.getElementById('outletnameinfo').appendChild(selectedOutlet);
    
    var userIdParam = "";
    if(getParameterByName('userid0')!=null && getParameterByName('userid')!="") {
        $("#useridinfo").removeClass("hide");
        userIdParam = "<span class='badge badge-primary'>" + getParameterByName('userid0') + "</span> ";
    }
    
    for (var i=1; i<=4; i++) {
        if(getParameterByName('userid' + i)!=null) {
            userIdParam += "<span class='badge badge-primary'>" + getParameterByName('userid' + i)  + "</span> ";      
        }
    }
    
    var selectedUser = document.createElement('small');
    selectedUser.innerHTML = "" + userIdParam;
    document.getElementById('useridinfo').appendChild(selectedUser);
    
    var userIdParams = "";
    if(getParameterByName('userid0')!=null && getParameterByName('userid')!="") {
        userIdParams = getParameterByName('userid0') + " ";   
    }
    
    for (var i=1; i<=4; i++) {
        if(getParameterByName('userid' + i)!=null) {
            userIdParams += getParameterByName('userid' + i) + " ";     
        }
    }
    
    var userIdParamsMod = userIdParams.slice(0, -1);
    
    
    
    $("#filterByDateFrom").val(dateFromParam);
    $("#filterByDateTo").val(dateToParam);
    $("#filterByTimeFrom").val(timeFromParam);
    $("#filterByTimeTo").val(timeToParam);
    $("#filterByWeekdayFrom").val(weekdayFromParam);
    $("#filterByWeekdayTo").val(weekdayToParam);
    $("#filterByYear").val(yearParam); 
    $("#filterByMonth").val(monthParam); 
    $("#filterByRetailerName").val(retailerNameParam);
    $("#filterByUserId").val(userIdParamsMod);
    $("#filterByTransactionType").val(transactionTypeParam);
    $("#filterByTotalAmountFrom").val(totalAmountFromParam);
    $("#filterByTotalAmountTo").val(totalAmountToParam);
    
    console.log(outletsParam);
    var outletsParamArr = outletsParam.split(";");
    var outletsParamArrMod = outletsParamArr.slice(0, -1);
    console.log(outletsParamArrMod);
//    if((outletsParamArrMod == 0 || outletsParamArrMod.length >= 3) && userIdParamsMod != 0)
//    {
//        $("#generateChartBtn").removeClass("invisible");
//    }
    
    
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
    
    $( "#createTribeBtn" ).click(function() {
        $( "#createTribe" ).toggleClass( "hide" );
    });
    
    $( "#tribeDescriptionsBtn" ).click(function() {
        $( "#tribeDescription" ).toggleClass( "hide" );
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
        
        if (title == "" || description == "") {
            alert("One of the required fields is empty. Title and description should not be empty.");
        }
        else {
            location.href = saveTribeReqUrl + "&title=" + title + "&description=" + description + "&datefrom=" + dateFrom + "&dateto=" + dateTo + "&timefrom=" + timeFrom + "&timeto=" + timeTo + "&weekdayfrom=" + weekdayFrom + "&weekdayto=" + weekdayTo + "&year="+ year +"&month=" + month + "&retailer="  + retailerName + "&outlet=" + outletName + "&newuserid=" + newUserId + "&transactiontype=" + transactionType + "&totalamountfrom=" + totalAmountFrom + "&totalamountto=" + totalAmountTo;
        }
    });
    
    $( ".tribeBtn" ).click(function() {
        var tribeID = $(this).val();
        console.log(tribeID);
        var splitTribe = tribeID.split(";");
        $("#filterByDateFrom").val(splitTribe[0]);
        $("#filterByDateTo").val(splitTribe[1]);
        $("#filterByTimeFrom").val(splitTribe[2]);
        $("#filterByTimeTo").val(splitTribe[3]);
        $("#filterByWeekdayFrom").val(splitTribe[4]);
        $("#filterByWeekdayTo").val(splitTribe[5]);
        $("#filterByYear").val(splitTribe[6]);
        $("#filterByMonth").val(splitTribe[7]);
        $("#filterByTotalAmountFrom").val(splitTribe[8]);
        $("#filterByTotalAmountTo").val(splitTribe[9]);
        $("#filterByRetailerName").val(splitTribe[10]);
        $("#filterByOutletName").val(splitTribe[11]);
        $("#filterByTransactionType").val(splitTribe[12]);
        $("#filterByUserId").val(splitTribe[13]);
        
        search();
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
    
    var userIds = userId.split(" ");
    var userIdUrl = "";
    if (userIds != null && userIds != "") {
        var arrayLength = userIds.length;
        if(arrayLength>5)
        {
            alert("Maximum amount of users should be not more than 5!")
            return;
        }
        else {
            for (var i = 0; i < arrayLength; i++) {
                userIdUrl += "&userid" + [i] + "=" + userIds[i];
            }
        }

    }
    console.log(userIdUrl);
    var outletNameUrl = "";
    
    if (outletName != null && outletName != "") {
        var arrayLength = outletName.length;
        for (var i = 0; i < arrayLength; i++) {
            outletNameUrl += "&outlet" + [i] + "=" + outletName[i];
        }
    }

    location.href = salesListReqUrl + "&datefrom=" + dateFrom + "&dateto=" + dateTo + "&timefrom=" + timeFrom + "&timeto=" + timeTo + "&weekdayfrom=" + weekdayFrom + "&weekdayto=" + weekdayTo + "&year="+ year +"&month=" + month + "&retailer="  + retailerName + outletNameUrl + userIdUrl + "&transactiontype=" + transactionType + "&totalamountfrom=" + totalAmountFrom + "&totalamountto=" + totalAmountTo;
   
}



