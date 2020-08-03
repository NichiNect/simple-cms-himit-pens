<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['judul', 'slug', 'content', 'gambar', 'user_id'];
    protected $table = 'articles';

	/**
 	* Method to take image with symbolic link from /storage
 	*/
    public function takeImageArticle() {
    	return '/storage/images/articles/' . $this->gambar;
    }

    /**
     * Method relation Many to One with User
     */
    public function user()
    {
    	return $this->belongsTo(\App\User::class, 'user_id');
    }
}
