@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <h1>{{ $question->title }}</h1>
                                <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all Questions</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="media">

                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">124</span>
                                <a title="This question is not useful">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="Click to mark as favourite question (Click again to undo)" class="favourite mt-2 favourited">
                                    <i class="fas fa-star fa-2x"></i>
                                    <span class="favourite-count">1234</span>
                                </a>
                            </div>

                            <div class="media-body">
                                {{ $question->body }}
                                <div class="float-right mt-2">
                                    <span class="text-muted">Answered {{ $question->created_date }}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="" style="width: 32px; height: 32px;">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        Displaying all the answers related to single question--}}
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="card-title">
                            <h2>{{ $question->answers_count . " ". \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}</h2>
                        </div>
                        <hr>
                        @foreach($question->answers as $answer)
                            <div class="media">

                                <div class="d-flex flex-column vote-controls">
                                    <a title="This answer is useful">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-count">124</span>
                                    <a title="This answer is not useful">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    <a title="Mark this answer as best answer" class="vote-accepted mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                </div>

                                <div class="media-body">
                                    {{ $answer->body }}
                                    <div class="float-right mt-2">
                                        <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                        <div class="media mt-2">
                                            <a href="{{ $answer->user->url }}" class="pr-2">
                                                <img src="{{ $answer->user->avatar }}" alt="" style="width: 32px; height: 32px;">
                                            </a>
                                            <div class="media-body mt-1">
                                                <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
