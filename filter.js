function filter() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("concern-table");
    tr = table.getElementsByTagName("tr");

    // If the input is empty, reset and show all rows
    if (!filter) {
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = ""; // Show all rows
        }
        return; // Exit the function early
    }

    // Filter rows based on the input
    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none"; // Hide all rows initially
        td = tr[i].getElementsByTagName("td");
        for (var j = 0; j < td.length; j++) {
            cell = td[j];
            if (cell) {
                if (cell.innerText.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = ""; // Show the row if it matches the filter
                    break;
                }
            }
        }
    }
}