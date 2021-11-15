<?php

namespace Database\Seeders;

use App\Models\Sentence;
use App\Models\SentenceHasWord;
use App\Models\Word;
use Illuminate\Database\Seeder;

class WordsAndSentencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = [
            'Abu', 'Berindang', 'Dingin', 'Tong', 'Kosong', 'Berbunyi',
            'Nyaring', 'Tak', 'Jadi', 'Bagai'
        ];

        foreach ($words as $word){
            Word::create(['name' => $word]);
        }

        $sentences = [
            'Tempat (air, paku, semen, dan sebagainya) yang dibuat dari papan kayu, plastik, dan sebagainya bentuknya bulat buluh',
            'Orang yang tidak tahu apa-apa tetapi berbicara sok tahu'
        ];

        foreach ($sentences as $sentence){
            Sentence::create(['meaning' => $sentence]);
        }

        $sentencesHasWords = [
            ['word_id' => '4', 'sentence_id' => '1', 'position' => '1'],
            ['word_id' => '4', 'sentence_id' => '2', 'position' => '1'],
            ['word_id' => '5', 'sentence_id' => '2', 'position' => '2'],
            ['word_id' => '6', 'sentence_id' => '2', 'position' => '3'],
            ['word_id' => '7', 'sentence_id' => '2', 'position' => '4'],
        ];

        foreach ($sentencesHasWords as $sentenceHasWords){
            SentenceHasWord::create($sentenceHasWords);
        }
    }
}
