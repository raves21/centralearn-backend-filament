<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChapterContent\Store;
use App\Http\Requests\ChapterContent\Update;
use App\Http\Services\ChapterContentService;
use App\Models\ChapterContent;
use Illuminate\Http\Request;

class ChapterContentController extends Controller
{
    protected $chapterContentService;

    public function __construct(ChapterContentService $chapterContentService)
    {
        $this->chapterContentService = $chapterContentService;
    }

    public function store(Store $request)
    {
        return $this->chapterContentService->create($request->validated());
    }
    /**
     * Display the specified resource.
     */
    public function show(string $chapterContentId)
    {
        return $this->chapterContentService->findById($chapterContentId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, string $chapterContentId)
    {
        return $this->chapterContentService->updateById($chapterContentId, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $chapterContentId)
    {
        return $this->chapterContentService->deleteById($chapterContentId);
    }
}
