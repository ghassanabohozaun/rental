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
        'owners' => 'global.owners',
        'guarantors' => 'global.guarantors',
        'customers' => 'global.customers',
        'maintenances' => 'global.maintenances',
        'contracts' => 'global.contracts',
        'cheques' => 'global.cheques',
        'payments' => 'global.payments',
    ],

    // Define icons for each module to keep Blade files clean
    'module_icons' => [
        'dashboard' => 'fas fa-th-large fa-fw',
        'settings' => 'fas fa-cogs fa-fw',
        'roles' => 'fas fa-user-shield fa-fw',
        'users' => 'fas fa-users-cog fa-fw',
        'departments' => 'fas fa-sitemap fa-fw',
        'companies' => 'fas fa-city fa-fw',
        'bank_accounts' => 'fas fa-university fa-fw',
        'properties' => 'fas fa-building fa-fw',
        'property_types' => 'fas fa-tags fa-fw',
        'property_statuses' => 'fas fa-info-circle fa-fw',
        'owners' => 'fas fa-user-friends fa-fw',
        'guarantors' => 'fas fa-shield-alt fa-fw',
        'customers' => 'fas fa-user-tie fa-fw',
        'maintenances' => 'fas fa-tools fa-fw',
        'contracts' => 'fas fa-file-contract fa-fw',
        'cheques' => 'fas fa-money-check-alt fa-fw',
        'payments' => 'fas fa-file-invoice-dollar fa-fw',
    ],

    // Define the CRUD operations available for these modules
    'crud_operations' => [
        'read' => 'general.show',
        'create' => 'general.add',
        'update' => 'general.update',
        'delete' => 'general.delete',
    ],
];
