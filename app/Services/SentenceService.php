<?php

namespace App\Services;

use App\Models\Sentence;
use App\Models\SentenceHasWord;
use App\Models\Word;
use Illuminate\Support\Facades\DB;

class SentenceService 
{
    public function createSentence($request)
    {
        $words = explode(',', $request['words']);
        $meaning = $request['meaning'];

        DB::beginTransaction();
        try {
            $createdSentence = Sentence::create(['meaning' => $meaning]);
            foreach ($words as $index => $word){
                $createdWord = Word::firstOrCreate(['name' => $word]);
                SentenceHasWord::create([
                    'word_id' => $createdWord->id,
                    'sentence_id' => $createdSentence->id,
                    'position' => $index + 1
                ]);
            }
           DB::commit();
        } catch(\Exception $error){
           DB::rollback();
           return $error;
        }
        return $createdSentence;
    }

    public function updateSentence($sentenceId, $request)
    {
        $words = explode(',', $request['words']);
        $meaning = $request['meaning'];
        DB::beginTransaction();
        try {
            SentenceHasWord::where('sentence_id', $sentenceId)->delete();
            $updatedSentence = Sentence::find($sentenceId)->update(['meaning' => $meaning]);
            foreach ($words as $index => $word){
                $createdWord = Word::firstOrCreate(['name' => $word]);
                SentenceHasWord::create([
                    'word_id' => $createdWord->id,
                    'sentence_id' => $sentenceId,
                    'position' => $index + 1
                ]);
            }
           DB::commit();
        } catch(\Exception $error){
           DB::rollback();
           return $error;
        }
        return $updatedSentence;
    }
}