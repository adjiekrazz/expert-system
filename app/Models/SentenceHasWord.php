<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentenceHasWord extends Model
{
    protected $table = 'sentences_has_words';
    public $timestamps = false;
    protected $fillable = ['word_id', 'sentence_id', 'position'];

    public function word(){
        return $this->belongsTo(Word::class, 'word_id', 'id');
    }
}
