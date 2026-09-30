<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Camiseta básica', 'descripcion' => 'Camiseta de algodón, varios colores', 'categoria' => 'Ropa', 'precio' => 25000, 'stock' => 40],
            ['nombre' => 'Jean clásico', 'descripcion' => 'Jean recto para hombre/mujer', 'categoria' => 'Ropa', 'precio' => 68000, 'stock' => 25],
            ['nombre' => 'Chaqueta impermeable', 'descripcion' => 'Chaqueta liviana resistente al agua', 'categoria' => 'Ropa', 'precio' => 95000, 'stock' => 15],
            ['nombre' => 'Arroz 1kg', 'descripcion' => 'Arroz blanco premium', 'categoria' => 'Alimentos', 'precio' => 4500, 'stock' => 100],
            ['nombre' => 'Aceite vegetal 1L', 'descripcion' => 'Aceite para cocinar', 'categoria' => 'Alimentos', 'precio' => 9800, 'stock' => 60],
            ['nombre' => 'Café molido 500g', 'descripcion' => 'Café tostado tradicional', 'categoria' => 'Alimentos', 'precio' => 15500, 'stock' => 50],
            ['nombre' => 'Juego de sábanas', 'descripcion' => 'Sábanas dobles, 100% algodón', 'categoria' => 'Hogar', 'precio' => 72000, 'stock' => 20],
            ['nombre' => 'Set de ollas', 'descripcion' => 'Juego de 5 ollas antiadherentes', 'categoria' => 'Hogar', 'precio' => 145000, 'stock' => 10],
            ['nombre' => 'Lámpara de mesa', 'descripcion' => 'Lámpara LED regulable', 'categoria' => 'Hogar', 'precio' => 38000, 'stock' => 18],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
