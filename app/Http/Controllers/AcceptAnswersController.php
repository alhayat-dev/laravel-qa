<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswersController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept');
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
