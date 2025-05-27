<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $primaryKey = "id";

    protected $fillable = ['title', 'summary', 'content', 'image', 'image_description', 'publish_date', 'featured'];
}
