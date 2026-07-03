<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $directory = storage_path('app/public/products');
        
        if (!File::exists($directory)) {
            $this->command->error("Directory {$directory} does not exist.");
            return;
        }

        $files = File::files($directory);

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $relativePath = 'products/' . $filename;

            // Create a new product
            $product = Product::create([
                'nombre' => 'Producto ' . $filename,
                'descripcion' => 'Descripción para ' . $filename,
                'cantidad' => rand(1, 100),
                'precio' => rand(10, 1000),
                'disponible' => true,
            ]);

            // Create the image and associate it with the product
            $product->images()->create([
                'url' => $relativePath,
            ]);
        }
        
        $this->command->info('Successfully seeded products with images.');
    }
}
