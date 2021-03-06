<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['index', 'show']);
    }

    /**
     *  Display all the questions
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $question =  new Question();
        return  view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AskQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->all());
        return redirect()->route('questions.index')->with('success', 'Your question has been submitted successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Question $question)
    {
          if (Gate::denies('update-question', $question)){
              abort(403, 'Access Denied');
          }
            return  view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AskQuestionRequest $request
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
//        if (Gate::denies('update-question', $question)){
//            abort(403, 'Access Denied');
//        }
        $this->authorize('update', $question);
        $question->update($request->only('title', 'body'));
        return redirect('/questions')->with('success', 'Your question has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
//        if (Gate::denies('update-question', $question)){
//            abort(403, 'Access Denied');
//        }
        $question->delete();
        return redirect('/questions')->with('success', 'Your question has been deleted.');
    }
}
