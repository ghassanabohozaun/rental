<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$role = App\Models\Role::find(1);
if($role) {
    $perm = App\Models\Permission::where('name', 'notifications_read')->first();
    if($perm) {
        $role->permissions()->syncWithoutDetaching([$perm->id]);
    }
}
echo "Done";
