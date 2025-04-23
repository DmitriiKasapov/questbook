<?php

return [
    'auth_login_redirect_path' => '/zadmin',
    'block_editor' => [
        'crops' => [
            'image' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 3 / 2,
                    ]
                ],
            ],
            'free' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 0,
                    ],
                ],
            ],
            'square' => [
                'default' => [
                    [
                        'name' => 'default',
                        'ratio' => 1,
                    ],
                ],
            ],
        ],
        'files' => [],
        'use_twill_blocks' => [],
    ],
    'dashboard' => [
        'modules' => [
            'App\Models\News' => [
                'name' => 'news',
                'label' => 'Novice',
                'label_singular' => 'Novica',
                'count' => true,
                'create' => true,
                'activity' => true,
                'draft' => true,
                'search' => true,
            ],
            'App\Models\NewsCategory' => [
                'name' => 'newsCategories',
                'label' => 'Kategorije novic',
                'label_singular' => 'Kategorija novice',
                'count' => true,
                'create' => true,
                'activity' => true,
                'draft' => true,
                'search' => true,
            ],
        ],
    ],
    'media_library' => [
        'allowed_extensions' => ['svg', 'jpg', 'gif', 'png', 'jpeg', 'webp'],
        // 'translated_form_fields' => true,
    ],
    'publish_date_24h' => true,
    'publish_date_format' => 'd. m. Y',
];
