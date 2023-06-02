<?php
/**
 * This file is used for creating the configuration for the plugin
 *
 * @author       Novalnet AG
 * @copyright(C) Novalnet
 * @license      https://www.novalnet.de/payment-plugins/kostenlos/lizenz
 */

namespace NovalnetWhatsapp\Assistants;

use NovalnetWhatsapp\Assistants\SettingsHandlers\NovalnetAssistantSettingsHandler;
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
            "title" => 'NovalnetAssistant.novalnetAssistantTitle',
            "shortDescription" => 'NovalnetAssistant.novalnetAssistantShortDescription',
            "iconPath" => $this->getIcon(),
            "settingsHandlerClass" => NovalnetAssistantSettingsHandler::class,
            "translationNamespace" => 'NovalnetWhatsapp',
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
                                        'name'          => 'NovalnetAssistant.clientId',
                                        'required'      => true,
                                        'listBoxValues' => $this->getWebstoreListForm(),
                                       ],
                ],
            ],
            "steps" => []
        ];
	
       $config = $this->createGeneralConfiguration($config);
       $config = $this->createAccountConfiguration($config);
       $config = $this->createURLConfiguration($config);
       $config = $this->createButtonStyleMobileConfiguration($config);
       $config = $this->createButtonStyleDesktopConfiguration($config);      
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
    * Create the Genaral configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createGeneralConfiguration($config)
    {
        $config['steps']['novalnetGeneralConf'] =
        [
            "title" => 'NovalnetAssistant.GeneralConf',
            "sections" => [
                [
                    "title"         => 'NovalnetAssistant.GeneralConf',
                    "description"   => 'NovalnetAssistant.GeneralConfDesc',
                    "form"          =>
                    [
                        'enableChat' =>
                        [
                            'type'         => 'checkbox',
                            'defaultValue' => true,
                            'options'   => [
                                            'name'  => 'NovalnetAssistant.enableChat'
                                           ]
                        ],
                        
			 'chatHeading' =>
                        [
                            'type'      => 'text',
                            'options'   => [				
                                            'name'      => 'NovalnetAssistant.chatHeading',
                                            'required'  => true,
				    	    'maxLength' => 70
                                           ]
                        ],
                        
                        'chatDescription' =>
                        [
                            'type'      => 'text',
                            'options'   => [
                                            'name'      => 'NovalnetAssistant.chatDescription',
                                            'required'  => true,   
				    	    'maxLength' => 70
                                           ]
                        ],                       
                        
                    ]
                ]
            ]
        ];
        return $config; 
    }
	
	
	/**
    * Create the Account configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createAccountConfiguration($config)
    {
        $config['steps']['novalnetAccountConf'] =
        [
            "title" => 'NovalnetAssistant.novalnetWebhookConf',  
            "sections" => [
                [
                    "title"         => 'NovalnetAssistant.novalnetWebhookConf',
                    "description"   => '',
                    "form"          =>
                    [
                        'mobileNumber' =>
                        [
                            'type'         => 'text',	
                            'options'   => [
                                            'name'  => 'NovalnetAssistant.mobileNumber',
                                            'required'  => true
                                           ]
                        ],
                        
						'accountName' =>
                        [
                            'type'      => 'text',
                            'options'   => [
                                            'name'      => 'NovalnetAssistant.accountName',
                                            'required'  => true
                                           ]
                        ],
                        
                        'accountRole' =>
                        [
                            'type'      => 'text',
                            'options'   => [
                                            'name'      => 'NovalnetAssistant.accountRole',
                                            'required'  => true,                                           
                                           ]
                        ],  
                        
						'profileLogo' =>
					    [
							'type'      => 'file',
							'options'   => [
											'name'              => 'NovalnetAssistant.profile',
											'showPreview'       => true,
											'allowedExtensions' => ['svg', 'png', 'jpg', 'jpeg'],
											'allowFolders'      => false
										   ]
						],                                            
                    ]
                ]
            ]
        ];
        return $config; 
    }
       
    /**
    * Create the URL configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createURLConfiguration($config)
    {
        $config['steps']['novalnetURLConf'] =
        [	
            "title" => 'NovalnetAssistant.novalnetURLConf',
            "sections" => [
                [
                    "title"         => 'NovalnetAssistant.novalnetURLConf',
                    "description"   => 'NovalnetAssistant.novalnetURLConfDesc',
                    "form"          =>
                    [
                        'openNewTab' =>
                        [
                            'type'         => 'checkbox',
                            'defaultValue' => true,
                            'options'   => [
                                            'name'  => 'NovalnetAssistant.openNewTab'
                                           ]
                        ],
                        
						'URLforDesktop' =>
						[
							'type'          => 'select',
							'defaultValue'  => 'web',
							'options'       => [
												'name'          => 'NovalnetAssistant.URLforDesktop',
												'listBoxValues' => [
																		[
																			'caption' => 'Web',
																			'value'   => 'web'
																		],
																		
																		[
																			'caption' => 'API',
																			'value'   => 'api'
																		],
																		
																		[
																			'caption' => 'Universal',
																			'value'   => 'universal'
																		],
																	],
																	 
											   ]
						],
                        
						'URLforMobile' =>
						[
							'type'          => 'select',
							'defaultValue'  => 'universal',
							'options'       => [
												'name'          => 'NovalnetAssistant.URLforMobile',
												'listBoxValues' => [
																		[	'caption' => 'Universal',
																			'value'   => 'universal'
																		],
																		
																		[
																			'caption' => 'API',
																			'value'   => 'api'
																		],
																		
																		[
																			'caption' => 'Web',
																			'value'   => 'web'
																		],
																	],	 
											   ]
						],                      
                        
                    ]
                ]
            ]
        ];
        return $config; 
    }
    
    
    /**
    * Create the button style for configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createButtonStyleMobileConfiguration($config)
    {
        $config['steps']['novalnetButtonStyleMobileConf'] =
        [	
            "title" => 'NovalnetAssistant.novalnetButtonStyleMobileConf',
            "sections" => [
                [
                    "title"         => 'NovalnetAssistant.novalnetButtonStyleMobileConf',
                    "description"   => '',
                    "form"          =>
                    [
                        'mobileTheme' =>
						[	
							'type'          => 'select',
							'defaultValue'  => 'green',
							'options'       => [
												'name'          => 'NovalnetAssistant.mobileTheme',
												'listBoxValues' => [
																		[	'caption' => 'Green',
																			'value'   => 'green'
																		],
																		
																		[
																			'caption' => 'White',
																			'value'   => 'white'
																		],	
																	],																								 
											   ]
						],
						
						'mobileShape' =>
						[	
							'type'          => 'select',
							'defaultValue'  => 'circle',
							'options'       => [
												'name'          => 'NovalnetAssistant.mobileShape',
												'listBoxValues' => [
																		[	'caption' => 'Circle',
																			'value'   => 'circle'
																		],
																		
																		[
																			'caption' => 'Rectangle',
																			'value'   => 'rectangle'
																		],			
																	],																						 
											   ]
						],                      
                        
                    ]
                ]
            ]
        ];
        return $config; 
    }
    
    /**
    * Create the button style for desktop configurations
    *
    * @param array $config
    *
    * @return array
    */
    public function createButtonStyleDesktopConfiguration($config)
    {
        $config['steps']['novalnetButtonStyleDesktopConf'] =
        [	
            "title" => 'NovalnetAssistant.novalnetButtonStyleDesktopConf',
            "sections" => [
                [
                    "title"         => 'NovalnetAssistant.novalnetButtonStyleDesktopConf',
                    "description"   => '',
                    "form"          =>
                    [
                        'desktopTheme' =>
						[
							'type'          => 'select',
							'defaultValue'  => 'green',
							'options'       => [	
												'name'          => 'NovalnetAssistant.desktopTheme',
												'listBoxValues' => [
																		[	'caption' => 'Green',
																			'value'   => 'green'
																		],
																		
																		[
																			'caption' => 'White',
																			'value'   => 'white'
																		],	
																	],																								 
											   ]
						],
						
						'desktopShape' =>
						[
							'type'          => 'select',
							'defaultValue'  => 'circle',
							'options'       => [
												'name'          => 'NovalnetAssistant.desktopShape',
												'listBoxValues' => [
																		[	'caption' => 'Circle',
																			'value'   => 'circle'
																		],
																		
																		[
																			'caption' => 'Rectangle',
																			'value'   => 'rectangle'
																		],	
																	],																								 
											   ]
						],                      
                        
                    ]
                ]
            ]
        ];
        return $config; 
    }
    
}
