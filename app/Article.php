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
        if (auth()->check() && !auth()->user()->is_admin) {
            static::addGlobalScope('user', function (Builder $builder) {
                $organizationId = auth()->user()->organization_id ? auth()->user()->organization_id : auth()->id();
                $builder->where('user_id', $organizationId);
            });
        }
    }
}
