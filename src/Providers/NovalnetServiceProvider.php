<?php

namespace NovalnetWhatsapp\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Log\Loggable;

class NovalnetServiceProvider extends ServiceProvider
{
	use Loggable;
	/**
	 * Register the service provider.
	 */
	public function register() 
	{

	}
	/**
	* Boot additional services for the payment method
	 *
	*/
	public function boot()
	{
	     // Set the Novalnet Assistant
	     pluginApp(WizardContainerContract::class)->register('template-novalnet-assistant', NovalnetAssistant::class);
	}
}
