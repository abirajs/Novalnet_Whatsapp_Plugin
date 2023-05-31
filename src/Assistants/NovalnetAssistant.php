<?php
/**
 * This file is used for creating the configuration for the plugin
 *
 * @author       Novalnet AG
 * @copyright(C) Novalnet
 * @license      https://www.novalnet.de/payment-plugins/kostenlos/lizenz
 */

namespace NovalnetWhatsapp\Assistants;


use Plenty\Modules\Wizard\Services\WizardProvider;
use Plenty\Modules\System\Contracts\WebstoreRepositoryContract;
use Plenty\Plugin\Application;


/**
 * Class NovalnetAssistant
 *
 * @package Novalnet\Assistants
 */
class NovalnetAssistant extends WizardProvider
{
  

    /**
     * @var WebstoreRepositoryContract
     */
    private $webstoreRepository;

    /**
     * @var $mainWebstore
     */
    private $mainWebstore;

    /**
     * @var $webstoreValues
     */
    private $webstoreValues;


    /**
    * Constructor.
    *
    * @param WebstoreRepositoryContract $webstoreRepository
    * @param PaymentHelper $paymentHelper
    */
    public function __construct(WebstoreRepositoryContract $webstoreRepository)
    {
        $this->webstoreRepository   = $webstoreRepository;
    }

    protected function structure()
    {
        $config =
        [
            "title" => 'NovalnetWhatsapp',
            "shortDescription" => 'Secure and Trust',
            "iconPath" => $this->getIcon(),
            "translationNamespace" => 'Novalnet1',
            "key" => 'template-novalnet-assistant',
            "topics" => ['template'],
            "priority" => 999,
            "options" =>
            [
                'clientId' =>
                [
                    'type'          => 'select',
                    'defaultValue'  => $this->getMainWebstore(),
                    'options'       => [
                                        'name'          => 'clientId',
                                        'required'      => true,
                                        'listBoxValues' => $this->getWebstoreListForm(),
                                       ],
                ],
            ],
            "steps" => []
        ];
	
       $config = $this->createGeneralConfiguration($config);
        return $config;
    }
          
   /**
     * Load Novalnet Icon
     *
     * @return string
     */
    protected function getIcon()
    {
        $app = pluginApp(Application::class);
        $icon = $app->getUrlPath('NovalnetWhatsapp').'/images/novalnet_icon.png';
        return $icon;
    }

    /**
     * Load main web store configuration
     *
     * @return string
     */
    private function getMainWebstore()
    {
        if($this->mainWebstore === null) {
            $this->mainWebstore = $this->webstoreRepository->findById(0)->storeIdentifier;
        }
        return $this->mainWebstore;
    }

    /**
     * Get the shop list
     *
     * @return array
     */
    private function getWebstoreListForm()
    {
        if($this->webstoreValues === null) {
            $webstores = $this->webstoreRepository->loadAll();
            $this->webstoreValues = [];
            /** @var Webstore $webstore */
            foreach($webstores as $webstore) {
                $this->webstoreValues[] = [
                    "caption" => $webstore->name,
                    "value" => $webstore->storeIdentifier,
                ];
            }
        }
        return $this->webstoreValues;
    }
	
    /**
    * Create the global configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createGeneralConfiguration($config)
    {
        $config['steps']['novalnetGeneralConf'] =
        [
            "title" => 'General',
            "sections" => [
                [
                    "title"         => 'General',
                    "description"   => ' ',
                    "form"          =>
                    [
                        'enableChat' =>
                        [
                            'type'         => 'checkbox',
                            'defaultValue' => true,
                            'options'   => [
                                            'name'  => 'Enable Whatsapp Chat'
                                           ]
                        ],
                        
						'chatHeading' =>
                        [
                            'type'      => 'text',
                            'options'   => [
                                            'name'      => 'Chat Heading',
                                            'required'  => true
                                           ]
                        ],
                        
                        'chatDescription' =>
                        [
                            'type'      => 'text',
                            'options'   => [
                                            'name'      => 'chat Description',
                                            'required'  => true,                                           
                                           ]
                        ],                       
                        
                    ]
                ]
            ]
        ];
        return $config; 
    }
	
}
