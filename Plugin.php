<?php namespace Fytinnovations\UserConnect;

use Backend;
use System\Classes\PluginBase;

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
            'fytinnovations.userconnect.some_permission' => [
                'tab' => 'UserConnect',
                'label' => 'Some permission'
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


    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'userconnect' => [
                'label'       => 'UserConnect',
                'url'         => Backend::url('fytinnovations/userconnect/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['fytinnovations.userconnect.*'],
                'order'       => 500,
            ],
        ];
    }
}
