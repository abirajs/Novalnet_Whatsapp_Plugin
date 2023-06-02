<?php

namespace NovalnetWhatsapp\Providers;

use NovalnetWhatsapp\Assistants\NovalnetAssistant;
use Plenty\Plugin\ServiceProvider;
use Plenty\Modules\Wizard\Contracts\WizardContainerContract;

class NovalnetServiceProvider extends ServiceProvider
{
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
