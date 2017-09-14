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
    var username, filter, table, tbody, tr, td, i;
    username = document.getElementById("filterByUserName");
    filter = username.value.toUpperCase();
    table = document.getElementById("users");
    tr = table.getElementsByTagName("tr");
    tbody = table.getElementsByTagName("tbody");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tbody.length; i++) {
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } 
                else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

