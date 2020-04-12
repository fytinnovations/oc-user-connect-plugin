<?php

namespace Fytinnovations\UserConnect;

use Backend;
use System\Classes\PluginBase;
use Event;
use Fytinnovations\Userconnect\Components\SubscriptionForm;

/**
 * UserConnect Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = [
        'Rainlab.Translate'
    ];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'fytinnovations.userconnect::lang.plugin.name',
            'description' => 'fytinnovations.userconnect::lang.plugin.description',
            'author'      => 'Fytinnovations',
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            SubscriptionForm::class => 'subscriptionForm'
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'fytinnovations.userconnect.manage_settings' => [
                'tab' => 'fytinnovations.userconnect::lang.plugin.name',
                'label' => 'fytinnovations.userconnect::lang.permissions.manage_settings'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'fytinnovations.userconnect::lang.settings.label',
                'description' => 'fytinnovations.userconnect::lang.settings.description',
                'icon'        => 'icon-cog',
                'class'       => 'Fytinnovations\UserConnect\Models\Settings',
                'order'       => 500,
                'keywords'    => 'userconnect subscriptions'
            ]
        ];
    }


    public function registerNavigation()
    {
        return [
            'userconnect' => [
                'label'       => 'fytinnovations.userconnect::lang.plugin.name',
                'url'         => Backend::url('fytinnovations/userconnect/subscribers'),
                'permissions' => ['fytinnovations.userconnect.manage_settings'],
                'iconSvg'     => 'plugins/fytinnovations/userconnect/assets/images/userconnect.svg',
                'sideMenu' => [
                    'subscribers' => [
                        'label'       => 'fytinnovations.userconnect::lang.subscribers.menu_label',
                        'icon'        => 'icon-users',
                        'url'         => Backend::url('fytinnovations/userconnect/subscribers'),
                    ],
                    'categories' => [
                        'label'       => 'fytinnovations.userconnect::lang.categories.menu_label',
                        'icon'        => 'icon-list',
                        'url'         => Backend::url('fytinnovations/userconnect/categories'),
                    ],
                    'settings' => [
                        'label'       => 'fytinnovations.userconnect::lang.settings.menu_label',
                        'icon'        => 'icon-cog',
                        'url'         => Backend::url('system/settings/update/fytinnovations/userconnect/settings'),
                        'permissions' => ['fytinnovations.userconnect.manage_settings'],
                    ]
                ]
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'fytinnovations.userconnect::mail.verify_subscriber',
        ];
    }
}
