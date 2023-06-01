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
    
    
    public function isMobileDev(){       
        if(!empty($_SERVER['HTTP_USER_AGENT'])){
           $user_ag = $_SERVER['HTTP_USER_AGENT'];
           if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
              return true;
           };
        };
    return false;
    }
}
