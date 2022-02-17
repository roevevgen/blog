<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
* Class BlogCategory
 *
 * @package App\Models
*
 * @property-read BlogCategory $parentCategory
 *
 * @property-read string       $parentTitle

*/
class BlogCategory extends Model
{
    use SoftDeletes;

    /**
     * ID Корня
     */
    const ROOT = 1;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description'
    ];

    /**
     * Получить родительскую категорию
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function  parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Пример аксесуара (Accessor)
     *
     * @url https://laravel.com/docs/5.8/eloquent-mutators
     *
     * @return string
     */
    public function getParentTitleAttribute(): string
    {
        $title = $this->parentCategory->title
            ?? ($this->isRoot()
                ? 'Корень'
                : '???');
        return $title;
    }

    /**
     * Является ли текущий обьект корневым
     *
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->id === BlogCategory::ROOT;
    }

//    /**
//     * Пример аксесуара
//     *
//     * @param string $valueFromDB
//     *
//     * @return bool|mixed|null|string|string[]
//     */
//    public function getTitleAttribute($valueFromObject)
//    {
//        return mb_strtoupper($valueFromObject);
//    }
//
//    /**
//     * Пример мутатора
//     *
//     * @param string $incomingValue
//     */
//    public function setTitleAttribute($incomingValue)
//    {
//        $this->attributes['title'] = mb_strtolower($incomingValue);
//    }
}
