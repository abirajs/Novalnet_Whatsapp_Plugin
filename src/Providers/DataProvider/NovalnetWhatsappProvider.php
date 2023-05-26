<?php

namespace Novalnet\Providers;

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
        return $twig->render('Novalnet::NovalnetWhatsappDataProvider');
    }
}
