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

$("#listingcorrect").change(function(){
   if($(this).val()=="2")
   {    
       $(".fakelisting").show();
   }
    else
    {
        $(".fakelisting").hide();
    }
});

$("#listingcorrect").change(function(){
   if($(this).val()=="3")
   {    
       $(".notreachable").show();
   }
    else
    {
        $(".notreachable").hide();
    }
});
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
$('#people-says-home').owlCarousel({
    loop:true,
    margin:30,
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
            items:4,
            nav:true,
            loop:true
        }
    }
});
$('.featured-blog').owlCarousel({
    loop:true,
    margin:30,
	navText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:true
        }
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

document.getElementById('buttonid').addEventListener('click', openDialog);
function openDialog() {
  document.getElementById('fileid').click();
}

  