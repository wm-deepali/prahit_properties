$('#all-categories').owlCarousel({
    loop:true,
    margin:10,
	navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:6,
            nav:true,
            loop:true
        }
    }
});
$("#feedback_select").change(function(){
   if($(this).val()=="1")
   {    
       $(".yes_feedback").show();
   }
    else
    {
        $(".yes_feedback").hide();
    }
});

$("#feedback_select").change(function(){
   if($(this).val()=="2")
   {    
       $(".no_feedback").show();
   }
    else
    {
        $(".no_feedback").hide();
    }
});


$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
   
function reloadPage(ms = null) {
  setTimeout(function() {
    location.reload();
  }, 1000);
}

function clearFormType(showMessage = null) {
  // if(!showMessage) return true;
  $(".add_formtype").empty();
  if(!showMessage) return true;
  $(".add_formtype").append(
    `<center class='m0-auto'> Please generate form for selected category or sub category </center>`
  );  
}