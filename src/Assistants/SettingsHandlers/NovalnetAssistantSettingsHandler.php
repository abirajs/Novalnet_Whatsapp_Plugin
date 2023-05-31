<?php
/**
 * This file is used to save all data created during 
 * the assistant process
 *
 * @author       Novalnet AG
 * @copyright(C) Novalnet
 * @license      https://www.novalnet.de/payment-plugins/kostenlos/lizenz
 */
namespace NovalnetWhatsapp\Assistants\SettingsHandlers;

use NovalnetWhatsapp\Services\SettingsService;
use Plenty\Modules\Plugin\PluginSet\Contracts\PluginSetRepositoryContract;
use Plenty\Modules\Wizard\Contracts\WizardSettingsHandler;

/**
 * Class NovalnetAssistantSettingsHandler
 *
 * @package Novalnet\Assistants\SettingsHandlers
 */
class NovalnetAssistantSettingsHandler implements WizardSettingsHandler
{
    public function handle(array $postData)
    {
        /** @var PluginSetRepositoryContract $pluginSetRepo */
        $pluginSetRepo = pluginApp(PluginSetRepositoryContract::class);
        $clientId = $postData['data']['clientId'];
        $pluginSetId = $pluginSetRepo->getCurrentPluginSetId();
        $data = $postData['data'];
        // Novalnet global and webhook configurations values
        $novalnetSettings=[
            'nn_whatsapp_enable_chat'       =>  $data['enableChat'] ?? '',
            'nn_whatsapp_chat_heading'      =>  $data['chatHeading'] ?? '',
            'nn_whatsapp_chat_description'  =>  $data['chatDescription'] ?? '',
            'nn_whatsapp_mobile_number'     =>  $data['mobileNumber'] ?? '',
            'nn_whatsapp_account_name'      =>  $data['accountName'] ?? '',
            'nn_whatsapp_account_role'      =>  $data['accountRole'] ?? '',
            'nn_whatsapp_profile_logo'      =>  $data['profileLogo'] ?? '',
            'nn_whatsapp_open_new_tab'  	=>  $data['openNewTab'] ?? '',
            'nn_whatsapp_url_desktop'       =>  $data['URLforDesktop'] ?? '',
            'nn_whatsapp_url_mobile'        =>  $data['URLforMobile'] ?? '',
            'nn_whatsapp_mobile_theme'      =>  $data['mobileTheme'] ?? '',
            'nn_whatsapp_mobile_shape'      =>  $data['mobileShape'] ?? '',
            'nn_whatsapp_desktop_theme'     =>  $data['desktopTheme'] ?? '',
            'nn_whatsapp_desktop_shape'     =>  $data['desktopShape'] ?? '',
        ];

        /** @var SettingsService $settingsService */
        $settingsService=pluginApp(SettingsService::class);
        $settingsService->updateSettings($novalnetSettings, $clientId, $pluginSetId);
        return true;
    }
}
