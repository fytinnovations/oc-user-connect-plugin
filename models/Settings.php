<?php namespace Fytinnovations\UserConnect\Models;

use Model;
use File;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        
    ];
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'fytinnovations_userconnect_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

}