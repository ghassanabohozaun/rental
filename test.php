<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$records = \App\Models\PropertyStatus::all();
echo "All statuses:\n";
foreach($records as $r) {
    echo "ID: " . $r->id . " Company: " . ($r->company_id ?? 'GLOBAL') . " Name AR: " . $r->getTranslation('name', 'ar') . " Name EN: " . $r->getTranslation('name', 'en') . "\n";
}
