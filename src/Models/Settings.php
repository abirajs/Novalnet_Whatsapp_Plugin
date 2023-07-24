<?php
/**
 * This file is used to create a settings model in the database
 *
 * @author       Novalnet AG
 * @copyright(C) Novalnet
 * @license      https://www.novalnet.de/payment-plugins/kostenlos/lizenz
 */
namespace NovalnetWhatsapp\Models;

use Carbon\Carbon;
use Plenty\Modules\Plugin\DataBase\Contracts\DataBase;
use Plenty\Modules\Plugin\DataBase\Contracts\Model;
use Plenty\Plugin\Log\Loggable;

/**
 * Class Settings
 *
 * @property int $id
 * @property int $clientId
 * @property int $pluginSetId
 * @property array $value
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @package Novalnet\Models
 */
class Settings extends Model
{
    use Loggable;

    public $id;
    public $clientId;
    public $pluginSetId;
    public $value = [];
    public $createdAt = '';
    public $updatedAt = '';

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return 'NovalnetWhatsapp::settings';
    }

    /**
     * Insert the configuration values into settings table
     *
     * @param array $data
     *
     * @return Model
     */
    public function create($data)
    {
        $this->clientId    = $data['clientId'];
        $this->pluginSetId = $data['pluginSetId'];
        $this->createdAt   = (string)Carbon::now();
        $this->value = [
			'nn_whatsapp_enable_chat'       =>  $data['nn_whatsapp_enable_chat'] ?? '',
            'nn_whatsapp_chat_heading'      =>  $data['nn_whatsapp_chat_heading'] ?? '',
            'nn_whatsapp_chat_description'  =>  $data['nn_whatsapp_chat_description'] ?? '',
            'nn_whatsapp_mobile_number'     =>  $data['nn_whatsapp_mobile_number'] ?? '',
            'nn_whatsapp_account_name'      =>  $data['nn_whatsapp_account_name'] ?? '',
            'nn_whatsapp_account_role'      =>  $data['nn_whatsapp_account_role'] ?? '',
            'nn_whatsapp_profile_logo'      =>  $data['nn_whatsapp_profile_logo'] ?? '',
            'nn_whatsapp_open_new_tab'  	=>  $data['nn_whatsapp_open_new_tab'] ?? '',
            'nn_whatsapp_url_desktop'       =>  $data['nn_whatsapp_url_desktop'] ?? '',
            'nn_whatsapp_url_mobile'        =>  $data['nn_whatsapp_url_mobile'] ?? '',
            'nn_whatsapp_mobile_theme'      =>  $data['nn_whatsapp_mobile_theme'] ?? '',
            'nn_whatsapp_mobile_shape'      =>  $data['nn_whatsapp_mobile_shape'] ?? '',
            'nn_whatsapp_desktop_theme'     =>  $data['nn_whatsapp_desktop_theme'] ?? '',
            'nn_whatsapp_desktop_shape'     =>  $data['nn_whatsapp_desktop_shape'] ?? '',
        ];
        return $this->save();
    }

    /**
     * Update the configuration values into settings table
     *
     * @param array $data
     *
     * @return Model
     */
    public function update($data)
    {
        if(isset($data['nn_whatsapp_enable_chat'])) {
            $this->value['nn_whatsapp_enable_chat'] = $data['nn_whatsapp_enable_chat'];
        }
        if(isset($data['nn_whatsapp_chat_heading'])) {
            $this->value['nn_whatsapp_chat_heading'] = $data['nn_whatsapp_chat_heading'];
        }
        if(isset($data['nn_whatsapp_chat_description'])) {
            $this->value['nn_whatsapp_chat_description']  = $data['nn_whatsapp_chat_description'];
        }
        if(isset($data['nn_whatsapp_mobile_number'])) {
            $this->value['nn_whatsapp_mobile_number'] = $data['nn_whatsapp_mobile_number'];
        }
        if(isset($data['nn_whatsapp_account_name'])) {
            $this->value['nn_whatsapp_account_name'] = $data['nn_whatsapp_account_name'];
        }
        if(isset($data['novalnet_webhook_testmode'])) {
            $this->value['novalnet_webhook_testmode'] = $data['novalnet_webhook_testmode'];
        }
        if(isset($data['novalnet_webhook_email_to'])) {
            $this->value['novalnet_webhook_email_to'] = $data['novalnet_webhook_email_to'];
        }
        if(isset($data['nn_whatsapp_account_role'])) {
            $this->value['nn_whatsapp_account_role'] = $data['nn_whatsapp_account_role'];
        }
        if(isset($data['nn_whatsapp_profile_logo'])) {
            $this->value['nn_whatsapp_profile_logo'] = $data['nn_whatsapp_profile_logo'];
        }
        if(isset($data['nn_whatsapp_open_new_tab'])) {
            $this->value['nn_whatsapp_open_new_tab'] = $data['nn_whatsapp_open_new_tab'];
        }
        if(isset($data['nn_whatsapp_url_desktop'])) {
            $this->value['nn_whatsapp_url_desktop'] = $data['nn_whatsapp_url_desktop'];
        }
        if(isset($data['nn_whatsapp_url_mobile'])) {
            $this->value['nn_whatsapp_url_mobile'] = $data['nn_whatsapp_url_mobile'];
        }
        if(isset($data['nn_whatsapp_mobile_theme'])) {
            $this->value['nn_whatsapp_mobile_theme'] = $data['nn_whatsapp_mobile_theme'];
        }
        if(isset($data['novalnet_guaranteed_sepa'])) {
            $this->value['novalnet_guaranteed_sepa'] = $data['novalnet_guaranteed_sepa'];
        }
        if(isset($data['nn_whatsapp_mobile_shape'])) {
            $this->value['nn_whatsapp_mobile_shape'] = $data['nn_whatsapp_mobile_shape'];
        }
        if(isset($data['nn_whatsapp_desktop_theme'])) {
            $this->value['nn_whatsapp_desktop_theme'] = $data['nn_whatsapp_desktop_theme'];
        }
        if(isset($data['nn_whatsapp_desktop_shape'])) {
            $this->value['nn_whatsapp_desktop_shape'] = $data['nn_whatsapp_desktop_shape'];
        }
        return $this->save();
    }

    /**
     * Save the configuration values into settings table
     *
     * @return Model
     */
    public function save()
    {
        /** @var DataBase $database */
        $database = pluginApp(DataBase::class);
        $this->updatedAt = (string)Carbon::now();
        // Log the configuration updated time for the reference
        $this->getLogger(__METHOD__)->error('Updated Novalnet settings details ' . $this->updatedAt, $this);
        return $database->save($this);
    }

    /**
     * Delete the configuration values into settings table
     *
     * @return bool
     */
    public function delete()
    {
        /** @var DataBase $database */
        $database = pluginApp(DataBase::class);
        return $database->delete($this);
    }
}
