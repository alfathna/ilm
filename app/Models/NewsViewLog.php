<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsViewLog extends Model
{
    protected $fillable = [
        'news_id',
        'viewed_date',
    ];

    protected function casts(): array
    {
        return [
            'viewed_date' => 'date',
        ];
    }

    /**
     * Get the news article this log belongs to.
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
