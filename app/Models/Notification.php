<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'description', 'seen', 'user_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'seen' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
