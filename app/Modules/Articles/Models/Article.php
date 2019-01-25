<?php

namespace App\Modules\Articles\Models;

use App\Base\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    public $table = 'articles';

    public $requestAttributes = [

      'title'          => 'like',
      'content'        => 'like',
      'tags'           => 'like',
      'article_images' => ''
    ];

    public $rules = [
      'common' => [
        'title'                  => 'required',
        'article_images.*.image' => 'image',
      ],
      'create' => [],
      'update' => ['id' => 'required'],
      'delete' => ['id' => 'required'],

    ];

    public function article_images()
    {
        return $this->hasMany(ArticleImages::class);
    }

    public function saveRelations($data)
    {

        if (!empty($data['article_images'])) {
            foreach ($data['article_images'] as $save) {
                if (isset($save['image']) && !empty($save['image'])) {
                    $path = $save['image']->store('images', 'public');
                    $dataToSave = [
                      'article_id' => $this->id,
                      'image'      => $path
                    ];
                    if (isset($save['id'])) {
                        $image = $this->article_images()->find($save['id']);
                        Storage::disk('public')->delete($image->image);
                        $image->update($dataToSave);
                    } else {
                        $this->article_images()->create($dataToSave);
                    }
                }
            }
        }
    }

}