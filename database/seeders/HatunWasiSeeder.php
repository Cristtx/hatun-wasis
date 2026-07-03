<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class HatunWasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // === TABLONES ===
            [
                'nombre' => 'Tablón Crema Carving',
                'descripcion' => 'Categoría: Tablón | Medida: 20x120 | Empaque: 5 PZ - 1.20 m² | Tablón cerámico de alta calidad con textura sutil carving, ideal para dar calidez a dormitorios y salas.',
                'cantidad' => 45,
                'precio' => 45.00,
                'disponible' => true,
                'image' => 'products/tablon_crema_carving.webp',
            ],
            [
                'nombre' => 'Tablón Secuoya Hueso',
                'descripcion' => 'Categoría: Tablón | Medida: 20x120 | Empaque: 5 PZ - 1.20 m² | Perfecto para darle un toque elegante y funcional a tus ambientes con su tono off-white hueso que amplía los espacios.',
                'cantidad' => 38,
                'precio' => 40.00,
                'disponible' => true,
                'image' => 'products/tablon_secuoya_hueso.webp',
            ],
            [
                'nombre' => 'Tablón Secuoya Beige',
                'descripcion' => 'Categoría: Tablón | Medida: 20x120 | Empaque: 5 PZ - 1.20 m² | Pensado para espacios que requieren belleza, firmeza y larga vida útil. Tono madera beige sumamente natural.',
                'cantidad' => 50,
                'precio' => 50.00,
                'disponible' => true,
                'image' => 'products/tablon_secuoya_beige.webp',
            ],
            [
                'nombre' => 'Tablón Dark Grey Carving',
                'descripcion' => 'Categoría: Tablón | Medida: 20x120 | Empaque: 5 PZ - 1.20 m² | Tablón de calidad superior para decoración y diseño industrial. Aporta gran carácter y contraste.',
                'cantidad' => 25,
                'precio' => 48.00,
                'disponible' => true,
                'image' => 'products/tablon_dark_grey_carving.webp',
            ],
            [
                'nombre' => 'Tablón Madera Caramelo',
                'descripcion' => 'Categoría: Tablón | Medida: 20x100 | Empaque: 6 PZ - 1.20 m² | Tablón de calidad para decoraciones y remodelaciones de alto impacto visual. Tono caramelo cálido.',
                'cantidad' => 60,
                'precio' => 42.00,
                'disponible' => true,
                'image' => 'products/tablon_madera_caramelo.webp',
            ],
            [
                'nombre' => 'Tablón Madera Pino Gris',
                'descripcion' => 'Categoría: Tablón | Medida: 20x100 | Empaque: 6 PZ - 1.20 m² | Perfecto para espacios contemporáneos, industriales o minimalistas. Veteado realista tipo madera de pino.',
                'cantidad' => 40,
                'precio' => 42.00,
                'disponible' => true,
                'image' => 'products/tablon_madera_pino_gris.webp',
            ],
            [
                'nombre' => 'Tablón Ébano Gris',
                'descripcion' => 'Categoría: Tablón | Medida: 20x100 | Empaque: 6 PZ - 1.20 m² | Recomendado para estilos modernos y sobrios. Su textura emula la madera noble de ébano envejecida.',
                'cantidad' => 30,
                'precio' => 44.00,
                'disponible' => true,
                'image' => 'products/tablon_ebano_gris.webp',
            ],
            [
                'nombre' => 'Tablón Madera Grey',
                'descripcion' => 'Categoría: Tablón | Medida: 20x100 | Empaque: 6 PZ - 1.20 m² | Tablón de calidad grisácea para decoraciones y remodelaciones rústicas elegantes.',
                'cantidad' => 35,
                'precio' => 43.00,
                'disponible' => true,
                'image' => 'products/tablon_madera_grey.webp',
            ],
            [
                'nombre' => 'Tablón Caramelo SL',
                'descripcion' => 'Categoría: Tablón | Medida: 30x60 | Empaque: 9 PZ - 1.68 m² | Tablón de buena calidad para renovación rápida. Tono ocre brillante.',
                'cantidad' => 80,
                'precio' => 38.00,
                'disponible' => true,
                'image' => 'products/tablon_caramelo_sl.webp',
            ],
            [
                'nombre' => 'Tablón Moka SL',
                'descripcion' => 'Categoría: Tablón | Medida: 30x60 | Empaque: 9 PZ - 1.62 m² | Tablón cerámico de gran resistencia en tonos marrones oscuros moka.',
                'cantidad' => 70,
                'precio' => 38.00,
                'disponible' => true,
                'image' => 'products/tablon_moka_sl.webp',
            ],
            [
                'nombre' => 'Tablón Parketon Premium Nut',
                'descripcion' => 'Categoría: Tablón | Medida: 20x61 | Empaque: 15 PZ - 1.86 m² | Tablón tipo parqué corto, ideal para remodelaciones residenciales con gran variedad de vetas.',
                'cantidad' => 90,
                'precio' => 36.00,
                'disponible' => true,
                'image' => 'products/tablon_parketon_premium_nut.webp',
            ],
            [
                'nombre' => 'Tablón Madero Blanco',
                'descripcion' => 'Categoría: Tablón | Medida: 20x61 | Empaque: 13 PZ - 1.61 m² | Tablón cerámico para decoraciones escandinavas y modernas que buscan luminosidad.',
                'cantidad' => 50,
                'precio' => 35.00,
                'disponible' => true,
                'image' => 'products/tablon_madero_blanco.webp',
            ],
            [
                'nombre' => 'Tablón Madera Ebony Caramelo SL',
                'descripcion' => 'Categoría: Tablón | Medida: 30x60 | Empaque: 9 PZ - 1.20 m² | Con enfoque de alta calidad y veteado profundo. Diseñado para un ambiente rústico acogedor.',
                'cantidad' => 45,
                'precio' => 39.00,
                'disponible' => true,
                'image' => 'products/tablon_madera_ebony_caramelo.webp',
            ],
            [
                'nombre' => 'Tablón Ebony Moka',
                'descripcion' => 'Categoría: Tablón | Medida: 30x60 | Empaque: 9 PZ - 1.62 m² | Cerámica de alto tránsito para renovaciones residenciales y comerciales exigentes.',
                'cantidad' => 55,
                'precio' => 39.00,
                'disponible' => true,
                'image' => 'products/tablon_ebony_moka.webp',
            ],
            [
                'nombre' => 'Tablón Paketon Madero Gris',
                'descripcion' => 'Categoría: Tablón | Medida: 20x61 | Empaque: 13 PZ - 1.61 m² | Formato clásico tipo duela de madera. Color gris cenizo muy estético.',
                'cantidad' => 65,
                'precio' => 34.00,
                'disponible' => true,
                'image' => 'products/tablon_paketon_madero_gris.webp',
            ],
            [
                'nombre' => 'Tablón Madera Aspen Miel',
                'descripcion' => 'Categoría: Tablón | Medida: 30x60 | Empaque: 8 PZ - 1.44 m² | Vetas sumamente realistas de pino americano en tonos miel cálido. Excelente textura al tacto.',
                'cantidad' => 48,
                'precio' => 37.00,
                'disponible' => true,
                'image' => 'products/tablon_madera_aspen_miel.webp',
            ],

            // === PEGAMENTOS ===
            [
                'nombre' => 'Pegamento San Lorenzo Extra Fuerte Gris',
                'descripcion' => 'Categoría: Pegamento | Peso: Bolsa 25 kg | Adhesivo estándar de gran rendimiento, ideal para la instalación de cerámicos en interiores y exteriores sobre superficies convencionales.',
                'cantidad' => 150,
                'precio' => 28.00,
                'disponible' => true,
                'image' => 'products/pegamiento_extra_fuerte_gris.webp',
            ],
            [
                'nombre' => 'Pegamento San Lorenzo Extra Fuerte Blanco',
                'descripcion' => 'Categoría: Pegamento | Peso: Bolsa 25 kg | Formulado con cemento blanco para evitar manchas en cerámicas de tonalidades claras y translúcidas.',
                'cantidad' => 120,
                'precio' => 32.00,
                'disponible' => true,
                'image' => 'products/pegamiento_extra_fuerte_blanco.webp',
            ],
            [
                'nombre' => 'Pegamento San Lorenzo Porcelanato',
                'descripcion' => 'Categoría: Pegamento | Peso: Bolsa 25 kg | Diseñado con aditivos poliméricos avanzados para garantizar la máxima adherencia en porcelanatos y gres de baja absorción.',
                'cantidad' => 200,
                'precio' => 38.00,
                'disponible' => true,
                'image' => 'products/pegamiento_porcelanato.webp',
            ],
            [
                'nombre' => 'Pegamento San Lorenzo Flexible Gris',
                'descripcion' => 'Categoría: Pegamento | Peso: Bolsa 25 kg | Altamente deformable y elástico. Recomendado para pisos con calefacción radiante, terrazas expuestas y zonas de tráfico industrial intenso.',
                'cantidad' => 100,
                'precio' => 45.00,
                'disponible' => true,
                'image' => 'products/pegamiento_flexible_gris.webp',
            ],
            [
                'nombre' => 'Pegamento San Lorenzo Blanco Flexible',
                'descripcion' => 'Categoría: Pegamento | Peso: Bolsa 25 kg | Adhesivo premium flexible blanco, ideal para formatos grandes, mármol y mosaicos de vidrio en piscinas y jacuzzis.',
                'cantidad' => 80,
                'precio' => 52.00,
                'disponible' => true,
                'image' => 'products/pegamiento_blanco_flexible.webp',
            ],
        ];

        foreach ($products as $item) {
            $imagePath = $item['image'];
            unset($item['image']);

            $product = Product::create($item);

            // Create polymorphic image entry
            $product->images()->create([
                'url' => $imagePath,
            ]);
        }
    }
}
