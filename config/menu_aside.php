<?php
// Aside menu

return [

        'konselor' => [
            [
                'title' => 'Dashboard',
                'root' => true,
                'icon' => 'flaticon-home-2', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/dashboard',
                'new-tab' => false,
            ],
            [
                'title' => 'Daftar Konseli',
                'root' => true,
                'icon' => 'flaticon-users', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/daftarkonseli',
                'new-tab' => false,
            ],
            [
                'title' => 'Case Conference',
                'root' => true,
                'icon' => 'flaticon2-group', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/caseconference',
                'new-tab' => false,
            ],
            [
                'title' => 'Arsip',
                'root' => true,
                'icon' => 'flaticon-folder-1', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/arsip',
                'new-tab' => false,
            ]
            ],
            'konseli' => [
                [
                    'title' => 'Dashboard',
                    'root' => true,
                    'icon' => 'flaticon-home-2', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '/dashboard',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Arsip',
                    'root' => true,
                    'icon' => 'flaticon-folder-1', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '/arsip',
                    'new-tab' => false,
                ]
            ],
            'admin' => [
                [
                    'title' => 'Dashboard',
                    'root' => true,
                    'icon' => 'flaticon-analytics', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '/admin/dashboard',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Kelola Konselor',
                    'root' => true,
                    'icon' => 'flaticon-user-settings', // or can be 'flaticon-home' or any flaticon-*
                    'page' => '/admin/konselor',
                    'new-tab' => false,
                ],
                [
                    'title' => 'Report',
                    'icon' => 'flaticon2-poll-symbol', // or can be 'flaticon-home' or any flaticon-*
                    'submenu' =>[
                            [
                                'title' => 'Presensi',
                                'root' => true,
                                'icon' => 'flaticon-list-3', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/report',
                                'new-tab' => false,
                            ],
                            [
                                'title' => 'Detail Konseling',
                                'root' => true,
                                'icon' => 'flaticon-list', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/report?detail=true',
                                'new-tab' => false,
                            ]
                    ]
                ],
                [
                    'title' => 'Setting',
                    'icon' => 'flaticon-cogwheel-2', // or can be 'flaticon-home' or any flaticon-*
                    'submenu' =>[
                            [
                                'title' => 'Expired Date',
                                'root' => true,
                                'icon' => 'flaticon-calendar-with-a-clock-time-tools', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/setting?submenu=expiration',
                                'new-tab' => false,
                            ],
                            [
                                'title' => 'Maksimum Konseli',
                                'root' => true,
                                'icon' => 'flaticon-warning', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/setting?submenu=maxkonseli',
                                'new-tab' => false,
                            ]
                    ]
                ],
                [
                    'title' => 'Informasi Pengumuman',
                    'icon' => 'flaticon-notes', // or can be 'flaticon-home' or any flaticon-*
                    'submenu' =>[
                            [
                                'title' => 'Pengumuman',
                                'root' => true,
                                'icon' => 'flaticon-exclamation-2', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/informasi?submenu=pengumuman',
                                'new-tab' => false,
                            ],
                            [
                            [
                                'title' => 'Quote',
                                'root' => true,
                                'icon' => 'flaticon-speech-bubble-1', // or can be 'flaticon-home' or any flaticon-*
                                'page' => '/admin/informasi?submenu=quote',
                                'new-tab' => false,
                            ]
                        ]
                    ]
                ]
            ]

    ];

if($u->role == 'konselor'){
    return [

        'items' => [
            // Dashboard
            [
                'title' => 'Dashboard',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/dashboard',
                'new-tab' => false,
            ],
            [
                'title' => 'Daftar Konseli',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/daftarkonseli',
                'new-tab' => false,
            ],
            [
                'title' => 'Case Conference',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/caseconference',
                'new-tab' => false,
            ],
            [
                'title' => 'Arsip',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/arsip',
                'new-tab' => false,
            ]
        ]

    ];
}else if($u->role == 'konseli'){

    return [

        'items' => [
            // Dashboard
            [
                'title' => 'Dashboard',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/dashboard',
                'new-tab' => false,
            ]
        ]
    ];

}else if($u->role == 'admin'){

    return [
        'items' => [
            // Dashboard
            [
                'title' => 'Dashboard',
                'root' => true,
                'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
                'page' => '/dashboard',
                'new-tab' => false,
            ]
        ]
            ];

}
