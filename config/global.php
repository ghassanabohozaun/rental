<?php
return [
    // Define the core modules that support CRUD permissions
    'modules' => [
        'settings' => 'global.settings',
        'roles' => 'global.roles',
        'users' => 'global.users',
        'departments' => 'global.departments',
        'companies' => 'global.companies',
        'bank_accounts' => 'global.bank_accounts',
        'properties' => 'global.properties',
        'property_types' => 'global.property_types',
        'property_statuses' => 'global.property_statuses',
        'guarantors' => 'global.guarantors',
    ],

    // Define icons for each module to keep Blade files clean
    'module_icons' => [
        'settings' => 'la-cog',
        'roles' => 'la-shield',
        'users' => 'la-users',
        'departments' => 'la-sitemap',
        'companies' => 'la-briefcase',
        'bank_accounts' => 'la-bank',
        'properties' => 'la-building',
        'property_types' => 'la-tags',
        'property_statuses' => 'la-info-circle',
        'guarantors' => 'la-shield',
    ],

    // Define the CRUD operations available for these modules
    'crud_operations' => [
        'read' => 'general.show',
        'create' => 'general.add',
        'update' => 'general.update',
        'delete' => 'general.delete',
    ],
];
