<?php

namespace App\Models;

use App\Models\Scopes\Builter;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderType extends Model
{
    use HasFactory;
    use Searchable;
    use Builter;

    protected $fillable = ['name', 'description','active'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean'
    ];
    protected $table = 'order_types';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
