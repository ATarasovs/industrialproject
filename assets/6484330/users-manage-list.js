$(document).ready(function() {
    console.log("Connected");
    initButtons();
    addContent();
});

function initButtons() {
    
}

function addContent() {
        
}

function filters() {
    // Declare variables
    var userid, username, filterByUserId, filterByUserName, table, tbody, tr, userIdColumn, userNameColumn, i;
    
    userid = document.getElementById("filterByUserId");
    filterByUserId = userid.value.toUpperCase();
    username = document.getElementById("filterByUserName");
    filterByUserName = username.value.toUpperCase();
    table = document.getElementById("users");
    tr = table.getElementsByTagName("tr");
    var tds = tr.getElementsByTagName('td');
    tbody = table.getElementsByTagName("tbody");
    console.log($("#filterByUserId").val());
    console.log($("#filterByUserName").val());

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tbody.length; i++) {
        for (i = 0; i < tr.length; i++) {
            userIdColumn = tds[0].getElementsByTagName();;
            userNameColumn = tds[1].getElementsByTagName();
;            if (userIdColumn) {
                if (userIdColumn.innerHTML.toUpperCase().indexOf(filterByUserId) > -1 || userNameColumn.innerHTML.toUpperCase().indexOf(filterByUserName) > -1)  {
                    tr[i].style.display = "";
                } 
                else {
                    tr[i].style.display = "none";
                }
//                if (userNameColumn.innerHTML.toUpperCase().indexOf(filterByUserName) > -1) {
//                    tr[i].style.display = "";
//                } 
//                else {
//                    tr[i].style.display = "none";
//                }
            }
            
        }
    }
    
//    for (i = 0; i < tbody.length; i++) {
//        for (i = 0; i < tr.length; i++) {
////            userIdColumn = tr[i].getElementsByTagName("td")[0];
//            userNameColumn = tr[i].getElementsByTagName("td")[1];
//            if (userNameColumn) {
//                if (userNameColumn.innerHTML.toUpperCase().indexOf(filterByUserName) > -1) {
//                tr[i].style.display = "";
//            } 
//            else {
//                tr[i].style.display = "none";
//            }
//                }
////            if (userNameColumn.innerHTML.toUpperCase().indexOf(filterByUserName) > -1) {
////                tr[i].style.display = "";
////            } 
////            else {
////                tr[i].style.display = "none";
////            }
//        }
//            
//    }
}

