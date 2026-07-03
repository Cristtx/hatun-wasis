<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Image;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Storage;

$count = 0;
$images = Image::all();
echo 'Found '.$images->count()." images in database.\n";

foreach ($images as $image) {
    if (! Storage::disk('public')->exists($image->url)) {
        echo 'Deleting missing image: '.$image->url."\n";
        $image->delete();
        $count++;
    }
}

echo "Cleanup complete. Deleted $count images.\n";
