function myFunction() {
 window.location.href = "https://web.whatsapp.com/send?phone=8754754860&text=hi how can i help you";
}

function manager() {
 window.location.href = "https://web.whatsapp.com/send?phone=9488732051&text=hi how can i help you";
}

function leader() {
 window.location.href = "https://web.whatsapp.com/send?phone=9488732052&text=hi how can i help you";
}

function employee() {
 window.location.href = "https://web.whatsapp.com/send?phone=8754754860&text=hi how can i help you";
}

$(document).ready(function(){
   $(".whatsappwidget").click(function(){
    $(".whatsappcontainer").toggle();
   });
 
   $(".whatsapp-cancel").click(function()	{
    $(".whatsappcontainer").hide();
  });
 
});
