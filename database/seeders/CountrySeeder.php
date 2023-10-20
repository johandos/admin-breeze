<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {

        $countries = [
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Estados Unidos', 'code' => 'US'],
            ['name' => 'Rusia', 'code' => 'RU'],
            ['name' => 'Brasil', 'code' => 'BR'],
            ['name' => 'México', 'code' => 'MX'],
            ['name' => 'Japón', 'code' => 'JP'],
            ['name' => 'Alemania', 'code' => 'DE'],
            ['name' => 'Reino Unido', 'code' => 'GB'],
            ['name' => 'Francia', 'code' => 'FR'],
            ['name' => 'Italia', 'code' => 'IT'],
            ['name' => 'Canadá', 'code' => 'CA'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Sudáfrica', 'code' => 'ZA'],
            ['name' => 'Egipto', 'code' => 'EG'],
            ['name' => 'Arabia Saudita', 'code' => 'SA'],
            ['name' => 'Corea del Sur', 'code' => 'KR'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'España', 'code' => 'ES'],
            ['name' => 'Grecia', 'code' => 'GR'],
        ];

        foreach ($countries as $country){
            Country::factory()->create($country);
        }

        Country::factory(2)->create();
    }
}
