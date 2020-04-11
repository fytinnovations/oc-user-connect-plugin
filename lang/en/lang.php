<?php

return [
    'plugin' => [
        'name' => 'User Connect',
        'description' => 'Creating and manage email subscription lists with ease.'
    ],
    'permissions' => [
        'manage_settings' => 'Manage User Connect Settings'
    ],
    'settings' => [
        'menu_label' => 'Settings',
        'label' => 'UserConnect Settings',
        'description' => 'Manage settings For User Connect'
    ],
    'subscribers' => [
        'menu_label' => 'Subscribers'
    ],
    'components' => [
        'subscriptionform' => [
            'name' => 'Subscription Form',
            'description' => 'Displays a form through which users can subscribe to mailing lists',
            'properties' => [
                'subscribeButtonText' => [
                    'title' => 'Subscribe button text',
                    'description' => 'The text to be displayed on the subscribe button.',
                    'default' => 'Subscribe'
                ],
                'successMessage' => [
                    'title' => 'Success Message',
                    'description' => 'Text to be displayed when the subscription is sucessful.',
                    'default' => 'Thankyou for subscribing.'
                ]
            ]
        ],
    ],
];
