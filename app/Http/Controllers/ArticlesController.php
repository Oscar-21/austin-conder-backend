<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Response;

class ArticlesController extends Controller
{
  // List of articles
  public function index()
  {
    /*$articles = Article::all();*/
    $articles = Article::take(4)->get();
    /*$articles = Article::orderBy("id","desc")->take(4)->get();*/
    return Response::json($articles);
  }

  //store our Article
  public function store(Request $request)
  {
    $article = new Article;
    $article->title = $request->input('title');
    $article->subheader = $request->input('subheader');
    $article->firstCharacter = $request->input('firstCharacter');

    $article->body = $request->input('body');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $article->image = $request->root()."/storage/".$imageName;


    $image2 = $request->file('image2');
    $imageName2 = $image2->getClientOriginalName();
    $image2->move("storage/", $imageName2);
    $article->image2 = $request->root()."/storage/".$imageName2;

    $article->save();

    return Response::json(["success" => "You did it"]);
  }

  // update our article
  public function update($id, Request $request)
  {
    $article = Article::find($id);
    $article->title = $request->input('title');
    $article->body = $request->input('body');
    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $article->image = $request->root()."/storage/".$imageName;
    $article->save();
    return Response::json(["success" => "Article Updated"]);
  }

  // show single article
    public function show($id)
  {
    $article = Article::find($id);
    return Response::json($article);
  }

    // delete a single article
    public function destroy($id)
  {
    $article = Article::find($id);
    $article->delete();

    return Response::json(['success' => 'Deleted Article.']);
  }

}
