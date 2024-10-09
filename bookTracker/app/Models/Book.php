<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'body',
        'category_id',
    ];

    protected $with = ['author','category'];
    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
