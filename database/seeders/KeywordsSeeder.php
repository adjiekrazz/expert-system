<?php

namespace Database\Seeders;
use App\Models\Keyword;
use Illuminate\Database\Seeder;

class KeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keywords = [
            [
                'text' => 'A',
                'children' => [
                    [
                        'text' => 'Abu',
                        'children' => [
                            [
                                'text' => 'Dingin',
                                'children' => [
                                    ['text' => 'Berindang Di Abu Dingin']
                                ]
                            ],
                            [
                                'text' => 'Tanggul',
                                'children' => [
                                    ['text' => 'Seperti Abu Di Atas Tanggul']
                                ]
                            ],
                            [
                                'text' => 'Arang',
                                'children' => [
                                    ['text' => 'Kalah Jadi Abu, Menang Jadi Arang']
                                ]
                            ]
                        ]
                    ],
                    [
                        'text' => 'Ada',
                        'children' => [
                            [
                                'text' => 'Udang',
                                'children' => [
                                    [
                                        'text' => 'Batu',
                                        'children' => [
                                            ['text' => 'Ada Udang Di Balik Batu']
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'text' => 'Kecil',
                                'children' => [
                                    [
                                        'text' => 'Pada',
                                        'children' => [
                                            ['text' => 'Asal Ada Kecil Pun Pada']
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($keywords as $keyword){
            Keyword::create($keyword);
        }
    }
}
