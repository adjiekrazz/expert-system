<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ['meaning'];
    
    public function words(){
        return $this->hasMany(SentenceHasWord::class, 'sentence_id', 'id');
    }
}
