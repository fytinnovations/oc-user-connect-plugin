<?php namespace Fytinnovations\Userconnect\Components;

use Cms\Classes\ComponentBase;

class SubscriptionForm extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'fytinnovations.userconnect::lang.components.subscriptionform.name',
            'description' => 'fytinnovations.userconnect::lang.components.subscriptionform.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}