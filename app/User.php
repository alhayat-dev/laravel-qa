<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(){
        return $this->hasMany(Question::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(){
        return route("questions.show", $this->id);;
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    /**
     * @return mixed
     */
    public function getAvatarAttribute(){
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
    }

    public function favourites()
    {
        return $this->belongsToMany(
                Question::class,
                'favourites',
                'user_id',
                'question_id'
            )->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'voteable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'voteable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('voteable_id', $question->id)->exists()){
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        }else{
            $voteQuestions->attach($question, ['vote' => $vote]);
        }
        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');

        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        if ($voteAnswers->where('voteable_id', $answer->id)->exists()){
            $voteAnswers->updateExistingPivot($answer, ['vote' => $vote]);
        }else{
            $voteAnswers->attach($answer, ['vote' => $vote]);
        }
        $answer->load('votes');
        $downVotes = (int) $answer->downVotes()->sum('vote');
        $upVotes = (int) $answer->upVotes()->sum('vote');

        $answer->votes_count = $upVotes + $downVotes;
        $answer->save();
    }
}
