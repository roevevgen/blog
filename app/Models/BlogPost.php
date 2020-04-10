<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogPost extends Model
{
    use SoftDeletes;
/** Категории в статье
 * @return BelongsTo
 */
    public function category()
    {
        //Статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }
    /**Автор статьи
     * @return BelongsTo
     */
    public function user()
    {
        //Статья принадлежит пользователю
        return $this->belongsTo(User::class);
    }
}
