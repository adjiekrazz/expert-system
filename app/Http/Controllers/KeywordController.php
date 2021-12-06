<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Services\KeywordService;

class KeywordController extends Controller
{
    public function index()
    {
        return view('pages.keyword.index');
    }

    public function getAll(KeywordService $service)
    {
        return response()->json($service->getKeywordTree());
    }

    // public function create(SentenceRequest $request, SentenceService $service)
    // {
    //     return response()->json(['data' => $service->createSentence($request->validated())]);
    // }

    public function createOrUpdate(KeywordService $service)
    {
        $data = json_decode(request()->keywords, true);
        return response()->json(['data' => $service->createOrUpdateTree($data)]);
    }

    // public function delete(Sentence $sentence)
    // {
    //     return response()->json(['data' => $sentence->delete()]);
    // }
}
