<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;
class AboutsController extends Controller
{

  public function index()
  {
    $abouts = About::find(1);
    /*$articles = Article::take(4)->get();*/
    /*$articles = Article::orderBy("id","desc")->take(4)->get();*/
    return Response::json($abouts);
  }

  //store our Article
  public function store(Request $request)
  {

    $validator = Validator::make(Purifier::clean($request->all()), [
      'header' => 'required',
      'header2' => 'required',
      'header3' => 'required',
      'body' => 'required',
      'body2' => 'required',
      'body3' => 'required',
      'image' => 'required',
      'image2' => 'required',
      'image3' => 'required',
    ]);

    if ($validator->fails()) {
      return Response::json(["error" => "You must fill out all fields."]);
    }
    $about = new About;
    $about->header = $request->input('header');
    $about->header2 = $request->input('header2');

    $about->header3 = $request->input('header3');
    $about->body = $request->input('body');
    $about->body2 = $request->input('body2');
    $about->body3 = $request->input('body3');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $about->image = $request->root()."/storage/".$imageName;

    $image2 = $request->file('image2');
    $imageName2 = $image2->getClientOriginalName();
    $image2->move("storage/", $imageName2);
    $about->image2 = $request->root()."/storage/".$imageName2;

    $image3 = $request->file('image3');
    $imageName3 = $image3->getClientOriginalName();
    $image3->move("storage/", $imageName3);
    $about->image3 = $request->root()."/storage/".$imageName3;
    $about->save();

    return Response::json(["success" => "You did it"]);
  }

  public function update($id, Request $request)
  {
    $about = About::find($id);
    $about->header = $request->input('header');
    $about->header2 = $request->input('header2');
    $about->header3 = $request->input('header3');
    $about->title = $request->input('body');
    $about->title = $request->input('body2');
    $about->title = $request->input('body3');

    $image = $request->file('image');
    $imageName = $image->getClientOriginalName();
    $image->move("storage/", $imageName);
    $about->image = $request->root()."/storage/".$imageName;

    $about->save();
    return Response::json(["success" => "About page Updated"]);
  }

   }
