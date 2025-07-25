<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Un;

class UnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uns = [
            [
                'unit' => 12,
                'business_unit' => 'Loja Colombo',
                'business_type' => 'Worten Resolve',
            ],
            [
                'unit' => 54,
                'business_unit' => 'Lojas Vasco da Gama',
                'business_type' => 'Retail',
            ],
            [
                'unit' => 33,
                'business_unit' => 'Loja NorteShopping',
                'business_type' => 'Retail',
            ],
            [
                'unit' => 15,
                'business_unit' => 'Loja Almada Fórum',
                'business_type' => 'Online',
            ],
            [
                'unit' => 55, 
                'business_unit' => 'Loja Fórum Coimbra',
                'business_type' => 'Online',
            ],
            [
                'unit' => 34,
                'business_unit' => 'Loja Braga',
                'business_type' => 'Loja Fisica',
            ],
            [
                'unit' => 45,
                'business_unit' => 'Loja Cascais Shopping',
                'business_type' => 'Retail',
            ],
            [
                'unit' => 67,
                'business_unit' => 'Loja Oeiras Parque',
                'business_type' => 'Online',
            ],
            [
                'unit' => 89,
                'business_unit' => 'Loja Gaia Shopping',
                'business_type' => 'Loja Fisica',
            ],
            [
                'unit' => 23,
                'business_unit' => 'Loja Amoreiras',
                'business_type' => 'Worten Resolve',
            ],
            [
                'unit' => 78,
                'business_unit' => 'Loja Leiria Shopping',
                'business_type' => 'Retail',
            ],
            [
                'unit' => 91,
                'business_unit' => 'Loja Évora Plaza',
                'business_type' => 'Online',
            ],
            [
                'unit' => 62,
                'business_unit' => 'Loja Coimbra Shopping',
                'business_type' => 'Loja Fisica',
            ],
            [
                'unit' => 39,
                'business_unit' => 'Loja Portimão Retail Center',
                'business_type' => 'Worten Resolve',
            ],
        ];

        foreach ($uns as $un) {
            Un::create($un);
        }
    }
}