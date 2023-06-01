<?php

namespace NovalnetWhatsapp\Providers\DataProvider;

use NovalnetWhatsapp\Services\SettingsService;
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
       	$settingsService    = pluginApp(SettingsService::class);
	//~ $accountName 		= $this->settingsService->getPaymentSettingsValue('nn_whatsapp_enable_chat');
	$accountName 		= 'test';
	$this->getLogger(__METHOD__)->error('AccountName', $accountName);
        return $twig->render('NovalnetWhatsapp::NovalnetWhatsappDataProvider',
			     [
				 'accountName' =>  $accountName,		
			     ]);
    }
}
