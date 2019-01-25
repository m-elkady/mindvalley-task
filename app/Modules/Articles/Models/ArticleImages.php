<?php

namespace App\Modules\Articles\Models;

use App\Base\Model;

class ArticleImages extends Model
{
    public $table = 'article_images';

    protected $fillable = ['article_id','image'];

    public $requestAttributes = [
        'image' => 'like',
    ];

    public $rules = [
        'common' => [
            'image' => 'required',
        ],
        'create' => [],
        'update' => ['id' => 'required'],
        'delete' => ['id' => 'required'],

    ];

    public $relations = [];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}