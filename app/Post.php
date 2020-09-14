<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\User;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'published_at', 'image', 'description', 'content', 'category_id', 'tags', 'user_id'
    ];

    protected $dates = [
         'published_at'
    ];
    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearched($query){
        $search = request()->query('search');
        if(!$search){
            return $query->published();
        }
        return $query->published()->where('title','LIKE', "%{$search}%");
    }

    public function scopePublished($query){
        return $query->where('published_at', '<=', now());
    }
}
