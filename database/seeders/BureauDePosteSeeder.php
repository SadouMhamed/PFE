<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BureauDePoste;

class BureauDePosteSeeder extends Seeder
{
    public function run()
    {
        BureauDePoste::create([
            'code' => 'BP001',
            'intitule_fr' => 'Bureau de Poste Central Alger',
            'intitule_ar' => 'مكتب بريد الجزائر المركزي'
        ]);

        BureauDePoste::create([
            'code' => 'BP002',
            'intitule_fr' => 'Bureau de Poste Oran',
            'intitule_ar' => 'مكتب بريد وهران'
        ]);
    }
}