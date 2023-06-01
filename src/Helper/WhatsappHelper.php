<?php
/**
 * This file is used for retrieve the details from the  shop instance
 *
 * @author       Novalnet AG
 * @copyright(C) Novalnet
 * @license      https://www.novalnet.de/payment-plugins/kostenlos/lizenz
 */
namespace NovalnetWhatsapp\Helper;

use Plenty\Plugin\Log\Loggable;
/**
 * Class PaymentHelper
 *
 * @package Novalnet\Helper
 */
class WhatsappHelper
{
    use Loggable;


    /**
     * Find the mobile device or not
     *
     * @return string
     */
    public function getIsMobile()
    {
       $test = 'test';
       return $test;
    }
}
