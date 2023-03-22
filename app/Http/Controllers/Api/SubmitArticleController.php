<?php

namespace App\Http\Controllers\Api;

use App\Enums\HttpStatusCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitArticleRequest;
use App\Http\Resources\SubmitArticleResource;
use App\Mail\MailArticleSubmitter;
use App\Models\SubmitArticle;
use App\Models\User;
use App\Notifications\ArticelActivity;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;

class SubmitArticleController extends Controller
{
    //

    public function index(Request $request) : JsonResponse
    {
        //
        $submittedArticles = QueryBuilder::for(SubmitArticle::class)
            ->allowedFilters(['authors_name', 'authors_email', 'title_of_article', 'country', 'status'])
            ->allowedSorts(['authors_name', 'authors_email', 'title_of_article', 'country', 'status'])
            ->allowedIncludes(['authors_name', 'authors_email', 'title_of_article', 'country', 'status'])
            ->paginate(20);
        $submittedArticles = SubmitArticleResource::collection($submittedArticles)->response()->getData(true);

        return $this->allListing(
            $submittedArticles,
            message: "Listed successfully"
        );

    }



    public function store(SubmitArticleRequest $request) : JsonResponse
    {
        //

        $request['status'] = 'pending';
        /** @var SubmitArticle $submitted */
        $submitted = SubmitArticle::create($request->validated());

        if($request->hasFile('article')){
            $submitted->addMediaFromRequest('article')->toMediaCollection('article');
        }

        //send mail to request email

        $message = "Your article with title: {$submitted->title_of_article} has been received successfully. We will get back to you shortly";
        Mail::to($submitted->authors_email)->send(new MailArticleSubmitter($message, $submitted->authors_name));

        //send mail to admin.
        $des = $submitted->title_of_article . ' has sent for review and publish.';

        User::all()->each(function($user) use ($des){

            if($user->hasRole('admin')){
                $user->notify(new ArticelActivity('New Article sent for publish', $des));
            }

        });


        return $this->success(
            message: 'Article submitted successfully',
            data: [new SubmitArticleResource($submitted)],
            status:HttpStatusCode::CREATED->value
        );
    }


    public function show(SubmitArticle $submitArticle) : JsonResponse
    {
        //
        return $this->success(
            message: "Article retrieved successfully",
            data: [new SubmitArticleResource($submitArticle)]

        );
    }

    public function update(Request $request, SubmitArticle $submitArticle) : JsonResponse
    {
        //
        $submitArticle->update(['status' => $request->status]);

        $message = "Your article with title: {$submitArticle->title_of_article} has been {$request->status} successfully. We will get back to you shortly";
        Mail::to($submitArticle->authors_email)->send(new MailArticleSubmitter($message, $submitArticle->authors_name));


        return $this->success(
            message: "Article updated successfully",
            data: [
                'article' => new SubmitArticleResource($submitArticle),
            ]

        );
    }


    public function destroy(SubmitArticle $submitArticle) : JsonResponse
    {
        //
        $submitArticle->delete();

        return $this->success(
            message: "Article deleted successfully",
            status: HttpStatusCode::SUCCESSFUL->value
        );
    }

}