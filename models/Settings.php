<?php

namespace Fytinnovations\UserConnect\Models;

use Model;
use Cms\Classes\Page;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'fytinnovations_userconnect_settings';

    public $settingsFields = 'fields.yaml';

    public function getVerificationSuccessPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'url');
    }
}
