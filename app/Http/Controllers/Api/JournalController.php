<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JournalRequest;
use App\Http\Requests\JournalUpdateRequest;
use App\Http\Resources\JournalResource;
use App\Models\Category;
use App\Models\Journal;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class JournalController extends Controller
{
    //
    public  function index(Request $request): JsonResponse
    {

        $journals = QueryBuilder::for(Journal::class)
            ->allowedFilters(['name', 'volume', 'issue', 'year', 'month', 'issn'])
            ->allowedIncludes(['category'])
            ->paginate(20);

        $journals = JournalResource::collection($journals)->response()->getData(true);

        return $this->allListing(
            $journals,
            'Journals retrieved successfully',
        );
    }

    public function show(Journal $journal): JsonResponse
    {
        $journal = new JournalResource($journal);

        return $this->success(
            message: 'Journal retrieved successfully',
            data: [
                'journal' => $journal
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    public function store(JournalRequest $request): JsonResponse
    {
        $category = Category::find($request->category_id);
        $journal = Journal::create($request->validated());
        $journal->category()->associate($category);


        return $this->success(
            message: 'Journal created successfully',
            data: [
                'journal' => $journal
            ],
            status: HttpStatusCode::CREATED->value
        );
    }

    public function update(JournalUpdateRequest $request, Journal $journal): JsonResponse
    {
        $journal->update($request->validated());

        return $this->success(
            message: 'Journal updated successfully',
            data: [
                'journal' => $journal
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    public function destroy(Journal $journal): JsonResponse
    {
        $journal->delete();

        return $this->success(
            message: 'Journal deleted successfully',
            data: [
                'journal' => $journal
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }
}
