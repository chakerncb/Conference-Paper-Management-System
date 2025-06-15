<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //
    protected $fillable = [
        'author_id',
        'title',
        'abstract',
        'keywords',
        'file_path',
        'status',
    ];


    /**
     * Get the author of the paper.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the reviews for the paper.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the reviewers assigned to this paper.
     */
    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'reviews', 'paper_id', 'reviewer_id');
    }
}
