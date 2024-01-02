<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'dashboard' => 'c,r,u,d',
            'update-form' => 'c,r,u,d',
            'update-item' => 'c,r,u,d',
            'update' => 'c,r,u,d',
            'add' => 'c,r,u,d',
            'delete' => 'c,r,u,d',
        ],
        'customer' => [
            'home' => 'c,r,u,d',
            'shop' => 'c,r,u,d',
            'cart' => 'c,r,u,d',
            'remove' => 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
