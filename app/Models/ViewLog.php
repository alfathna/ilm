<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ViewLog extends Model
{
    protected $fillable = [
        'viewable_type',
        'viewable_id',
        'viewed_date',
    ];

    protected function casts(): array
    {
        return [
            'viewed_date' => 'date',
        ];
    }

    /**
     * Get the parent viewable model (News, Video, or Gallery).
     */
    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
