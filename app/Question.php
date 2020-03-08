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
}
