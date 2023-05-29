$(document).ready(function(){
   $(".whatsappwidget").click(function(){
    $(".whatsappcontainer").toggle();
   });
 
   $(".whatsapp-cancel").click(function()	{
    $(".whatsappcontainer").hide();
  });
 
});

function whatsapp(id) { 
	var phone   =  $('.member'+id).attr("phone");
	var message =  'Hi how can i help you..'; 
	alert(phone); 
	alert(message);
	//~ window.location.href = "https://web.whatsapp.com/send?phone=8754754860&text=hi how can i help you";
}
