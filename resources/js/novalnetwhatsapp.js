$(document).ready(function(){
   $(".whatsappwidget").click(function(){
    $(".whatsappcontainer").toggle();
   });
 
   $(".whatsapp-cancel").click(function()	{
    $(".whatsappcontainer").hide();
  });
 
});

function whatsapp(id) {
    var apiEndPoint = 'https://';
    var phone   =  $('.member'+id).attr("phone");
    var message =  'Hi how can i help you..'; 
alert(jQuery('#nn_whatsapp_is_mobile').val());
    // Find the mobile devices and redirect the api endpoint url
    if(jQuery('#nn_whatsapp_is_mobile').val() == 'true') {
		if(jQuery('#nn_whatsapp_mobile_URL').val() == 'web') {
			apiEndPoint = apiEndPoint+'web.whatsapp.com/send?phone=' + phone + '&text=' + (message);
			alert(apiEndPoint);
		} else if(jQuery('#nn_whatsapp_mobile_URL').val() == 'api') {
			apiEndPoint = apiEndPoint+'api.whatsapp.com/send?phone=' + phone + '&text=' + (message);
			alert(apiEndPoint);
		} else if(jQuery('#nn_whatsapp_mobile_URL').val() == 'universal') {
			apiEndPoint = apiEndPoint+'wa.me/' + phone + '?text=' + (message);
			alert(apiEndPoint);
		}		
	} 
    alert(jQuery('#nn_whatsapp_desktop_URL').val());
    // Find the desktop devices and redirect the api endpoint url
    if(jQuery('#nn_whatsapp_is_mobile').val() == 'false') {
		if(jQuery('#nn_whatsapp_desktop_URL').val() == 'web') {
			apiEndPoint = apiEndPoint+'web.whatsapp.com/send?phone=' + phone + '&text=' + (message);
			alert(apiEndPoint);
		} else if(jQuery('#nn_whatsapp_desktop_URL').val() == 'api') {
			apiEndPoint = apiEndPoint+'api.whatsapp.com/send?phone=' + phone + '&text=' + (message);
			alert(apiEndPoint);
		} else if(jQuery('#nn_whatsapp_desktop_URL').val() == 'universal') {
			apiEndPoint = apiEndPoint+'wa.me/' + phone + '?text=' + (message);
			alert(apiEndPoint);
		}		
	} 
  alert(apiEndPoint);  
    // set the new tab open redirect page
    if(jQuery('#nn_whatsapp_open_new_tab').val() == 'true') {
	window.open(apiEndPoint);
    } else {
	window.location.href = apiEndPoint;
    }		
}
