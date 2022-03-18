$(document).ready(function() {
    let floor = 4;
    $.ajax({
        type: "POST",
        url: "fetchFloor.php",
        data: {
            floor: floor
        },
        dataType: "html",
        success: function(data) {
            $("#table-container").html(data);
        }
    })
});
    
$(document).on('click', '#showDataF4', function(e) {
    document.getElementById("F4").className += " active";
    document.getElementById("F5").className = "page-item";
    let floor = document.getElementById("showDataF4").value;
    $.ajax({
        type: "POST",
        url: "fetchFloor.php",
        data: {
            floor: floor
        },
        dataType: "html",
        success: function(data) {
            $("#table-container").html(data);
        }
    });
});

$(document).on('click', '#showDataF5', function(e) {
    document.getElementById("F5").className += " active";
    document.getElementById("F4").className = "page-item";
    let floor = document.getElementById("showDataF5").value;
    $.ajax({
        type: "POST",
        url: "fetchFloor.php",
        data: {
            floor: floor
        },
        dataType: "html",
        success: function(data) {
            $("#table-container").html(data);
        }
    });
});