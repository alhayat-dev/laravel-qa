<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'body', 'name'];

    /**
     * Return user associated with the question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(){
        return route("questions.show", $this->slug);
    }

    /**
     * @return mixed
     */
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    /**
     * @return string
     */
    public function getStatusAttribute(){
        if ($this->answers_count > 0){
            if ($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    /**
     * @param $answer
     */
    public function acceptBestAnswer($answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favourites()
    {
       return $this->belongsToMany(
           User::class,
           'favourites',
           'question_id',
           'user_id')->withTimestamps();
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', Auth()->id())->count() > 0;
    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouriteCountAttribute()
    {
        return $this->favourites->count();
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'voteable');
    }

    public function downVotes()
    {
        return $this->votes()->wherePivot('vote',-1);
    }

    public function upVotes()
    {
        return $this->votes()->wherePivot('vote',1);
    }

}
