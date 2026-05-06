<?php
return [
    // Define the core modules that support CRUD permissions
    'modules' => [
        'companies' => 'global.companies',
        'settings' => 'global.settings',
        'roles' => 'global.roles',
        'users' => 'global.users',
        'departments' => 'global.departments',
        'bank_accounts' => 'global.bank_accounts',
        'properties' => 'global.properties',
        'property_types' => 'global.property_types',
        'property_statuses' => 'global.property_statuses',
        'guarantors' => 'global.guarantors',
        'customers' => 'global.customers',
        'maintenances' => 'global.maintenances',
        'contracts' => 'global.contracts',
        'cheques' => 'global.cheques',
        'payments' => 'global.payments',
    ],

    // Define icons for each module to keep Blade files clean
    'module_icons' => [
        'dashboard' => 'fas fa-th-large',
        'settings' => 'fas fa-cogs',
        'roles' => 'fas fa-user-shield',
        'users' => 'fas fa-users-cog',
        'departments' => 'fas fa-sitemap',
        'companies' => 'fas fa-city',
        'bank_accounts' => 'fas fa-university',
        'properties' => 'fas fa-building',
        'property_types' => 'fas fa-tags',
        'property_statuses' => 'fas fa-info-circle',
        'guarantors' => 'fas fa-shield-alt',
        'customers' => 'fas fa-user-tie',
        'maintenances' => 'fas fa-tools',
        'contracts' => 'fas fa-file-contract',
        'cheques' => 'fas fa-money-check-alt',
        'payments' => 'fas fa-file-invoice-dollar',
    ],

    // Define the CRUD operations available for these modules
    'crud_operations' => [
        'read' => 'general.show',
        'create' => 'general.add',
        'update' => 'general.update',
        'delete' => 'general.delete',
    ],
];
