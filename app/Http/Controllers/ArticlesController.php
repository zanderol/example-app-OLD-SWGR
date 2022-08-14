<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticlesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/articles",
     *     operationId="articlesAll",
     *     tags={"Articles"},
     *     summary="Display a listing of the resource",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *      response="404",
     *      description="Article not found"
     *      ),
     *     @OA\Response(
     *      response="",
     *      description="Everything is fine"
     *      )
     * )
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $articles = Article::query()->paginate(4);

        return response()->json([
            "articles" => new ArticleCollection($articles)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = Article::create([
            "title" => $request->title,
            "body" => $request->body
        ]);
        return $article;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return response()->json([
            "article" => new ArticleResource($article)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        $article->title = $request->title;
        $article->body = $request->body;

        $article->save();

        return $article;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                "status" => false,
                "message" => "Article with ID {{ $id }} not found"
            ])->setStatusCode(404, 'Article Not Found');
        }

        $article->delete();

        return response()->json([
            "status" => true,
            "message" => "Deleted successfuly"
        ]);
    }

//    Search by Title value in DB.

    public function search($searchVar){

        return Article::where("title", "like", "%".$searchVar."%")->get();
    }
}
