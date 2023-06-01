<?php

namespace NovalnetWhatsapp\Providers\DataProvider;

use NovalnetWhatsapp\Services\SettingsService;
use NovalnetWhatsapp\Helper\WhatsappHelper;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Log\Loggable;

class NovalnetWhatsappProvider extends ServiceProvider
{
	use Loggable;
	/**
	 * Register the service provider.
	 */
    public function call(Twig $twig):string
    {
       	$settingsService        = pluginApp(SettingsService::class);
	$whatsappHelper         = pluginApp(WhatsappHelper::class);
	
	$enableChat 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_enable_chat');
	$chatHeading 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_chat_heading');
	$chatDescription	= $settingsService->getPaymentSettingsValue('nn_whatsapp_chat_description');
	$accountName 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_account_name');
	$accountRole		= $settingsService->getPaymentSettingsValue('nn_whatsapp_account_role');
	$mobileNumber 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_mobile_number');
	$profileLogo 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_profile_logo');
	$openNewTab 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_open_new_tab');
	$desktopURL 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_url_desktop');
	$mobileURL 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_url_mobile');
	$mobileTheme 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_mobile_theme');
	$mobileShape 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_mobile_shape');
	$desktopTheme 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_desktop_theme');
	$desktopShape 		= $settingsService->getPaymentSettingsValue('nn_whatsapp_desktop_shape');
	
	$isMobile 		= $whatsappHelper->getIsMobile();
	$isMobileDev 		= $whatsappHelper->getIsMobileDev();
	    
	$this->getLogger(__METHOD__)->error('ProfileLogo', $profileLogo);
	$this->getLogger(__METHOD__)->error('isMobile', $isMobile);
	$this->getLogger(__METHOD__)->error('isMobileDev', $isMobileDev);
	    
	if($enableChat == 'true') { 
		return $twig->render('NovalnetWhatsapp::NovalnetWhatsappDataProvider',
							[
								'accountName' 		=>  $accountName,		
								'accountRole' 		=>  $accountRole,		
								'chatHeading' 		=>  $chatHeading,		
								'chatDescription' 	=>  $chatDescription,		
								'mobileNumber' 	    =>  $mobileNumber,		
								'profileLogo' 	    =>  $profileLogo,		
								'openNewTab' 		=>  $openNewTab,		
								'desktopURL' 		=>  $desktopURL,		
								'mobileURL' 		=>  $mobileURL,		
								'mobileTheme' 		=>  $mobileTheme,		
								'mobileShape' 		=>  $mobileShape,		
								'desktopTheme' 		=>  $desktopTheme,		
								'desktopShape' 		=>  $desktopShape,		
							]);
	} else {
		return '';
	}
    }
}
