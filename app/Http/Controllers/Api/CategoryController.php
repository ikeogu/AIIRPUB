<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{

    // index
    public function index(): JsonResponse
    {
        //
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters([
                'title',
                'description',
                'status',
            ])
            ->allowedSorts([
                'title',
                'description',
                'status',
            ])
            ->allowedFields([
                'title',
                'description',
                'status',
            ])
            ->paginate(25);

        $categories = CategoryResource::collection($categories)->response()->getData(true);

        return $this->allListing(
            $categories,
            message: 'categories fetched successfully',
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    // show

    public function show(Category $category): JsonResponse
    {
        //
        return $this->success(
            message: 'category fetched successfully',
            data: [
                'category' => new CategoryResource($category)
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    // store

    public function store(CategoryRequest $request): JsonResponse
    {
        //
        /** @var Category $category */
        $category = Category::create($request->validated());


        if (!empty($request->validated()['cover_photo'])) {
            $category->addMediaFromRequest('cover_photo')->toMediaCollection('cover_photo');
        }

        return $this->success(
            message: 'category created successfully',
            data: [
                'category' => new CategoryResource($category)
            ],
            status: HttpStatusCode::CREATED->value
        );
    }

    // update

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        //
        $category->update($request->validated());

        return $this->success(
            message: 'category updated successfully',
            data: [
                'category' => new CategoryResource($category)
            ],
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    // destroy

    public function destroy(Category $category): JsonResponse
    {
        //
        $category->delete();

        return $this->success(
            message: 'category deleted successfully',
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }
}
