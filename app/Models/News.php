<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'content', 'municipality_id'];

    protected $searchableFields = ['*'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
