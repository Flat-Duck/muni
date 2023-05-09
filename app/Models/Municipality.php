<?php

namespace App\Models;

use App\Models\Scopes\Builter;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;
    use Searchable;
    use Builter;

    protected $fillable = ['name', 'description','active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $searchableFields = ['*'];

    public function allNews()
    {
        return $this->hasMany(News::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
