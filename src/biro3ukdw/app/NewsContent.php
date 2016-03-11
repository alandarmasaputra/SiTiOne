<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news_content extends Model
{
    protected $table = 'news_contents';
    protected $fillable = ['news_id','id','type','content'];
}
