<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'full_text', 'category_id', 'user_id', 'published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->is_admin && !auth()->user()->is_publisher) {
            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('user_id', auth()->id());
            });
        }
    }
}
