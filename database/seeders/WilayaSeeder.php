<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayas = [
            ['upw' => 'Adrar'],
            ['upw' => 'Chlef'],
            ['upw' => 'Laghouat'],
            ['upw' => 'Oum El Bouaghi'],
            ['upw' => 'Batna'],
            ['upw' => 'Béjaïa'],
            ['upw' => 'Biskra'],
            ['upw' => 'Béchar'],
            ['upw' => 'Blida'],
            ['upw' => 'Bouira'],
            ['upw' => 'Tamanrasset'],
            ['upw' => 'Tébessa'],
            ['upw' => 'Tlemcen'],
            ['upw' => 'Tiaret'],
            ['upw' => 'Tizi Ouzou'],
            ['upw' => 'Alger'],
            ['upw' => 'Djelfa'],
            ['upw' => 'Jijel'],
            ['upw' => 'Sétif'],
            ['upw' => 'Saïda'],
            ['upw' => 'Skikda'],
            ['upw' => 'Sidi Bel Abbès'],
            ['upw' => 'Annaba'],
            ['upw' => 'Guelma'],
            ['upw' => 'Constantine'],
            ['upw' => 'Médéa'],
            ['upw' => 'Mostaganem'],
            ['upw' => 'M\'Sila'],
            ['upw' => 'Mascara'],
            ['upw' => 'Ouargla'],
            ['upw' => 'Oran'],
            ['upw' => 'El Bayadh'],
            ['upw' => 'Illizi'],
            ['upw' => 'Bordj Bou Arréridj'],
            ['upw' => 'Boumerdès'],
            ['upw' => 'El Tarf'],
            ['upw' => 'Tindouf'],
            ['upw' => 'Tissemsilt'],
            ['upw' => 'El Oued'],
            ['upw' => 'Khenchela'],
            ['upw' => 'Souk Ahras'],
            ['upw' => 'Tipaza'],
            ['upw' => 'Mila'],
            ['upw' => 'Aïn Defla'],
            ['upw' => 'Naâma'],
            ['upw' => 'Aïn Témouchent'],
            ['upw' => 'Ghardaïa'],
            ['upw' => 'Relizane'],
            ['upw' => 'El M\'Ghair'],
            ['upw' => 'El Meniaa'],
            ['upw' => 'Ouled Djellal'],
            ['upw' => 'Bordj Baji Mokhtar'],
            ['upw' => 'Béni Abbès'],
            ['upw' => 'Timimoun'],
            ['upw' => 'Touggourt'],
            ['upw' => 'Djanet'],
            ['upw' => 'In Salah'],
            ['upw' => 'In Guezzam']
        ];

        DB::table('wilayas')->insert($wilayas);
    }
}
