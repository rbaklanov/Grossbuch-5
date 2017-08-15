<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'manager' => [
            'profile' => 'r,u'
        ],
        'ceo' => [
            'profile' => 'r,u'
        ],
        'user' => [
            'profile' => 'r,u'
        ],
        'client' => [
            'profile' => 'r,u'
        ]
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];