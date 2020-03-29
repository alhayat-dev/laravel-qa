<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h2>{{ $answersCount . " ". \Illuminate\Support\Str::plural('Answer', $answersCount) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                    <div class="media">
 ad libero aut sequi error. Earum autem nulla est aut. Assumenda optio et similique ex non. In omnis iusto qui nisi consequatur quisquam. Expedita illum repellat quisquam vel voluptatem. Nihil suscipit consequatur et eum sint. Rerum veritatis sit placeat enim aut sed rerum rerum. Debitis error dolores non accusamus. Odio quo neque et est voluptatem. Cumque quia tempora rerum quod. Omnis rerum qui corporis eos. Et sed repellat aliquid doloribus. Mollitia optio reiciendis nam eos quis ut. At error eum harum maxime eius quod. Natus aliquid reiciendis quo voluptas occaecati deserunt. Hic nesciunt laudantium quos.
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">{{ $answer->question->votes_count }}</span>
                            <a title="This answer is not useful">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            @can('accept', $answer)
                                <a title="Mark this answer as best answer"
                                   class="{{ $answer->status }} mt-2"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();">
                                    <i class="fas fa-check fa-2x"></i>

                                    <form action="{{ route('answers.accept', $answer->id) }}" method="POST" id="accept-answer-{{$answer->id}}" style="display: none">
                                        @csrf
                                    </form>
                                </a>
                            @else
                                @if($answer->is_best)
                                    <a title="Mark this answer as best answer" class="{{ $answer->status }} mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan

                        </div>

                        <div class="media-body">
                            {{ $answer->body }}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan

                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
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

                        </div>
                    </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
</div>
