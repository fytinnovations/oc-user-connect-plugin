<?php namespace Fytinnovations\UserConnect;

use Backend;
use System\Classes\PluginBase;
use Event;
/**
 * UserConnect Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'UserConnect',
            'description' => 'Connect with your user easily with easy to 
                              enable features which includes newsletter
                              subscription and social floating action buttons',
            'author'      => 'Fytinnovations',
            'icon'        => 'icon-leaf'
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
            'Fytinnovations\UserConnect\Components\Newsletter' => 'ucNewsletter',
            'Fytinnovations\UserConnect\Components\SocialFabs' => 'ucSocialFabs',
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
                'tab' => 'UserConnect',
                'label' => 'Allow the user to change userconnect settings'
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'UserConnect Settings',
                'description' => 'Manage newsletters and social icons.',
                'icon'        => 'icon-cog',
                'class'       => 'Fytinnovations\UserConnect\Models\Settings',
                'order'       => 500,
                'keywords'    => 'userconnect newsletter'
            ]
        ];
    }


    public function registerNavigation()
    {
        return [
            'userconnect' => [
                'label'       => 'UserConnect',
                'url'         => Backend::url('fytinnovations/userconnect/subscribers'),
                'icon'        => 'icon-pencil',
                'permissions' => ['fytinnovations.userconnect.manage_settings'],
                'iconSvg'     => 'plugins/fytinnovations/userconnect/assets/images/userconnect.svg',
                'sideMenu' => [
                    'subscribers' => [
                        'label'       => 'Subscribers',
                        'icon'        => 'icon-users',
                        'url'         => Backend::url('fytinnovations/userconnect/subscribers'),
                        'permissions' => ['fytinnovations.userconnect.manage_settings'],
                    ],
                    'settings' => [
                        'label'       => 'Settings',
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
            'fytinnovations.userconnect::mail.subscriber_verification',
        ];
    }
}
