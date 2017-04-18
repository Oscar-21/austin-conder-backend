<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchesController extends Controller
{
  // List of articles
  public function index()
  {
    $searches = Search::all();
    /*$searches = Search::take(4)->get();*/
    /*$Searches = Search::orderBy("id","desc")->take(4)->get();*/
    return Response::json($searches);
  }

  public function store(Request $request)
  {
    $validator = Validator::make(Purifier::clean($request->all()), [
      'title' => 'required',
      'genre' => 'required',
      'decade' => 'required',
      'director' => 'required',
    ]);

    if ($validator->fails()) {
      return Response::json(["error" => "You must fill out all fields."]);
    }


    $search = new Search;
    $search->title = $request->input('title');
    $search->genre = $request->input('genre');
    $search->decade = $request->input('decade');
    $search->director = $request->input('director');

    $search->save();

    return Response::json(["success" => "You did it"]);
  }


  public function update($id, Request $request)
  {
    $search = Search::find($id);
    $search->title = $request->input('title');
    $search->genre = $request->input('genre');
    $search->decade = $request->input('decade');
    $search->director = $request->input('director');
    $search->save();
    return Response::json(["success" => "Search index Updated"]);
  }
  // show single search result
  public function show($id)
  {
    $search = Search::find($id);
    return Response::json($search);
  }

  // delete a single search result
  public function destroy($id)
  {
    $search = Search::find($id);
    $search->delete();
    return Response::json(['success' => 'Deleted search item.']);
  }
}
