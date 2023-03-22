<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Mail\ArticlePublished;
use App\Models\Article;
use App\Models\Journal;
use App\Notifications\ArticelActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    //
    public function index(Request $request) : JsonResponse
    {
        $article = Article::with('journal')->latest();

        $articles = QueryBuilder::for($article)
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

        $articles = ArticleResource::collection($articles)->response()->getDate();

        return $this->allListing(
          $articles,
          message:'All articles'
        );
    }

    public function show(Article $article) : JsonResponse
    {
        $article = new ArticleResource($article);

        return $this->success(
          message:'Article details',
          data: $article,
          status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    public function store(ArticleRequest $request) : JsonResponse
    {
       try {
            //code...
            /** @var \App\Models\User $user */
            $user = auth()->user();

            $slug = Str::slug($request->title);

            $data = array_merge($request->validated(), ['slug' => $slug]);
            /** @var Article $article */
            $article = Article::create($data);

            if ($request->hasFile('attachment')) {
                $article->addMediaFromRequest('attachment')->toMediaCollection('attachment');
            }

            /** @var Journal $journal */
            $journal  = Journal::find($request->journal_id);

            $article->journal()->associate($journal);


            $msg = ' Hope this finds you well, we have successfully published your article with title ' . $article->title .
                ' on our platform., thank you for your contribution.';

            Mail::to($article->authors_email)->send(new ArticlePublished($msg, $article->authors_name));

            $des = $article->title . ' has been published';
            $user->notify(new ArticelActivity('Article published', $des));

            return $this->success(
                message: 'Article Published successfully',
                data: $article,
                status: HttpStatusCode::CREATED->value
            );
       } catch (\Throwable $th) {
        //throw $th;
        Log::info("::::::: Article not published :::::::");
        Log::error($th->getMessage());
        Log::info("::::::: Article not published :::::::");
        return $this->failure(
            message: 'Article not published',
            status: HttpStatusCode::SERVER_ERROR->value
        );
       }
    }


    public function update(UpdateArticleRequest $request, Article $article) : JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        $article->update($request->validated());

        if($request->hasFile('attachment')) {
            $article->addMediaFromRequest('attachment')->toMediaCollection('attachment');
        }

        $des = $article->title . ' has been published';
        $user->notify(new ArticelActivity('Article published', $des));

        return $this->success(
          message:'Article updated successfully',
          data: $article,
          status: HttpStatusCode::SUCCESSFUL->value
        );
    }

    public function destroy(Article $article) : JsonResponse
    {
        $article->delete();

        return $this->success(
          message:'Article deleted successfully',
          status: HttpStatusCode::SUCCESSFUL->value
        );
    }


}