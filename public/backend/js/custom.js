$(document).ready( function () {
    $('#for_all').DataTable();
} );
$("#add_linked_to").change(function(){
 if($(this).val()=="1")
 {    
   $(".my_ad_properties").show();
 }
 else
 {
  $(".my_ad_properties").hide();
}
});
$("#add_linked_to").change(function(){
 if($(this).val()=="2")
 {    
   $(".my_ad_customurl").show();
 }
 else
 {
  $(".my_ad_customurl").hide();
}
});

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Registrations',
            backgroundColor: '#6777ef',
            borderColor: '#4659e7',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Total (Traffic)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: '2,50,000'
      }
    }
});

new Chart(document.getElementById("hourstrans"), {
  type: 'line',
  data: {
    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999],
    datasets: [{ 
        data: [86,1124,106,106,107,111,133,221,6783],
        label: "12:00AM - 02:00PM",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [282,350,3411,502,635,809,947,1402,4700],
        label: "02:00PM - 04:00PM",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [168,170,178,190,2033,276,408,547,375],
        label: "04:00PM - 06:00PM",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [40,20,10,16,24,38,74,167,508],
        label: "06:00PM - 08:00PM",
        borderColor: "#e8c3b9",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Total Transaction Made: 1,02,878'
    }
  }
});

    jQuery.validator.addMethod("restrict_special_chars", function(value, element) {
        if(value.length == 0 && value == "") {
          return true;
        }
        if (/[a-zA-Z0-9-]$/.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, 'Special characters not allowed. Please try again.');

function reloadPage(ms = null) {
  setTimeout(function() {
    location.reload();
  }, 1000);
}

function populate_slug(slug_field_id, current_el) {
    let r = Math.random().toString(36).substring(6);
    var this_value = $.trim(current_el.value);
    var allowedChars = [];
    for(let i in this_value) {
        var current = this_value[i];
        if(current.match(/[ a-zA-Z0-9]+$/)) {
          if(current == " ") {
            current = "-";
          }
          allowedChars.push(current);
        }
    }

    $("#"+slug_field_id).val(allowedChars.join('')+'-'+r);
}


function delete_row(id) {
  $("table tbody #"+id).remove();
}

function clearFormType(showMessage = null) {
  // if(!showMessage) return true;
  $(".add_formtype").empty();
  if(!showMessage) return true;
  $(".add_formtype").append(
    `<center class='m0-auto'> Please generate form for selected category or sub category </center>`
  );  
}