<?php

namespace Fytinnovations\UserConnect\Controllers;
use BackendMenu;
use  Fytinnovations\UserConnect\Models\Subscriber;

class Subscribers extends \Backend\Classes\Controller {

    public $implement = ['Backend.Behaviors.ListController'];

    public $listConfig = 'list_config.yaml';

    public function __construct(){
        parent::__construct();
        BackendMenu::setContext('Fytinnovations.UserConnect', 'userconnect', 'subscribers');
    }

    public function index()
    {
        $this->vars['verified_subscribers']=Subscriber::verified()->count();
        $this->vars['unverified_subscribers']=Subscriber::unverified()->count();
        $this->asExtension('ListController')->index();
    }

}

?>