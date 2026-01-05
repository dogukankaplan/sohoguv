<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['name' => 'Akbank', 'order' => 1],
            ['name' => 'Aliağa Belediyesi', 'order' => 2],
            ['name' => 'Aliağa Fen Bilimleri', 'order' => 3],
            ['name' => 'Atakent Lisesi', 'order' => 4],
            ['name' => 'Barçın Spor', 'order' => 5],
            ['name' => 'Burada Lojistik', 'order' => 6],
            ['name' => 'Burger King', 'order' => 7],
            ['name' => 'Byrack', 'order' => 8],
            ['name' => 'DBD Otel', 'order' => 9],
            ['name' => 'Deniz Kuvvetleri Komutanlığı', 'order' => 10],
            ['name' => 'Denizbank', 'order' => 11],
            ['name' => 'Dürümle', 'order' => 12],
            ['name' => 'EGS Mutfak', 'order' => 13],
            ['name' => 'Ekin Koleji', 'order' => 14],
            ['name' => 'Hava Kuvvetleri Komutanlığı', 'order' => 15],
            ['name' => 'Hilltown AVM', 'order' => 16],
            ['name' => 'Isonem', 'order' => 17],
            ['name' => 'İZSU', 'order' => 18],
            ['name' => 'İzmir Büyükşehir Belediyesi', 'order' => 19],
            ['name' => 'Jandarma ve Sahil Güvenlik Komutanlığı', 'order' => 20],
            ['name' => 'Kara Kuvvetleri Komutanlığı', 'order' => 21],
            ['name' => 'LC Waikiki', 'order' => 22],
            ['name' => 'Migros', 'order' => 23],
            ['name' => 'Özhan Marketler Zinciri', 'order' => 24],
            ['name' => 'Pehlivanoğlu', 'order' => 25],
            ['name' => 'TCDD', 'order' => 26],
            ['name' => 'Total Enerji', 'order' => 27],
            ['name' => 'Vestel', 'order' => 28],
            ['name' => 'Yanmar', 'order' => 29],
            ['name' => 'Ziraat Bankası', 'order' => 30],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['name' => $client['name']], // Aynı isimde varsa güncelle
                [
                    'logo' => null,
                    'website' => null,
                    'order' => $client['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
