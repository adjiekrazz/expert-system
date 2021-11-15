<?php

namespace App\Http\Controllers;

use App\Http\Requests\SentenceRequest;
use App\Models\Sentence;
use App\Services\SentenceService;

class SentenceController extends Controller
{
    public function index()
    {
        return view('pages.sentence.index');
    }

    public function getAll()
    {
        return response()->json(Sentence::with(['words' => function($query){
            return $query->with('word')->orderBy('position', 'ASC');
        }])->paginate(10));
    }

    public function create(SentenceRequest $request, SentenceService $service)
    {
        return response()->json(['data' => $service->createSentence($request->validated())]);
    }

    public function update(Sentence $sentence, SentenceRequest $request, SentenceService $service)
    {
        return response()->json(['data' => $service->updateSentence($sentence->id, $request->validated())]);
    }

    public function delete(Sentence $sentence)
    {
        return response()->json(['data' => $sentence->delete()]);
    }
}
