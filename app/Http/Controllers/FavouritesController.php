<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
//        return $question->isFavourited() ? 'true' : 'false';
        $question->favourites()->attach(auth()->id());
        return back();
    }

    public function destroy(Question $question)
    {
//        return "destriy";
        $question->favourites()->detach(auth()->id());
        return back();
    }
}
