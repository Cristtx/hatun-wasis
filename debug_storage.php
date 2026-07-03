<?php

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

echo "Public disk root: " . Storage::disk('public')->path('') . "\n";
echo "Checking if assets/img/products/prod_img_1.jpeg exists...\n";
if (Storage::disk('public')->exists('assets/img/products/prod_img_1.jpeg')) {
    echo "YES, it exists!\n";
} else {
    echo "NO, it does not exist.\n";
    // Let's try without the 'assets/img/products/' prefix just in case
    if (Storage::disk('public')->exists('prod_img_1.jpeg')) {
        echo "YES, it exists with just the filename!\n";
    }
}
