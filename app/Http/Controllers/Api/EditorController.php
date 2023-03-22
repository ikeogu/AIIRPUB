<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Enums\HttpStatusCode;
use App\Http\Requests\EditorRequest;
use App\Http\Requests\EditorUpdateRequest;
use App\Http\Resources\EditorResource;
use App\Models\Editor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class EditorController extends Controller
{

    public function index(Request $request): JsonResponse
    {

        //use query builder to get all editors
        $editors = QueryBuilder::for(Editor::class)
            ->allowedFilters([
                'name',
                'title',
                'qualification',
                'employed_at',
                'email',
                'number_of_publications',
            ])
            ->allowedSorts([
                'name',
                'title',
                'qualification',
                'employed_at',
                'email',
                'number_of_publications',
            ])
            ->allowedFields([
                'name',
                'title',
                'qualification',
                'employed_at',
                'email',
                'number_of_publications',
            ])
            ->paginate(25);

        $editors = EditorResource::collection($editors)->response()->getData(true);

        return $this->allListing(
            $editors,
            message: 'editors fetched successfully',

        );
    }


    public function store(EditorRequest $request): JsonResponse
    {
        //
        $editor = Editor::create($request->validated());

        return $this->success(
            message: 'editor created successfully',
            data: [
                'editor' => new EditorResource($editor)
            ],
            status: HttpStatusCode::CREATED->value
        );
    }


    public function show(Editor $editor): JsonResponse
    {
        //
        return $this->success(
            message: 'editor fetched successfully',
            data: [
                'editor' => new EditorResource($editor)
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }


    public function update(EditorUpdateRequest $request, Editor $editor): JsonResponse
    {
        //
        $editor->update($request->validated());

        return $this->success(
            message: 'editor updated successfully',
            data:[
                'editor' => new EditorResource($editor)
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }


    public function destroy(Editor $editor): JsonResponse
    {
        //
        $editor->delete();

        return $this->success(
            message: 'editor deleted successfully',
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }
}