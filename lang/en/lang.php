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
        'label' => 'User Connect Settings',
        'description' => 'Manage settings For User Connect',
        'fields' => [
            'verify_emails' =>
            [
                'label' => 'Verify Via Email',
                'comment' => 'Validate the correctness of the Email'
            ],
            'key_expires_in' =>
            [
                'label' => 'Key Expires In (Days)',
            ],
            'verification_success_page' =>
            [
                'label' => 'Verification Success Page',
                'comment' => 'The page to redirect the user when the verification is successful'
            ],
        ]
    ],
    'general' => [
        'fields' => []
    ],
    'subscribers' => [
        'list_title' => 'Subscribers',
        'menu_label' => 'Subscribers',
        'verified' => 'Verified Subscribers',
        'unverified' => 'Unverified Subscribers',
        'export' => 'Export Subscribers',
        'filter' => [
            'verified' => 'Verified',
            'subscribed_between' => 'Subscribed Between',
            'verified_between' => 'Verified Between'
        ]
    ],
    'subscriber' => [
        'fields' => [
            'id' => [
                'label' => 'ID'
            ],
            'email' => [
                'label' => 'Email'
            ],
            'is_verified' => [
                'label' => 'Is Verified'
            ],
            'verified_at' => [
                'label' => 'Verified At'
            ],
            'created_at' => [
                'label' => 'Created At'
            ],
            'updated_at' => [
                'label' => 'Updated At'
            ],
        ]
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
    'mail' => [
        'verify_subscriber' => [
            'subject' => 'Please confirm your subscription.'
        ],
        'user_verified_successfully' => 'Thankyou, Your email has been verified.'
    ]
];
