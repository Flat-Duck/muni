<?php

namespace App\Models;

use App\Models\Scopes\Builter;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintType extends Model
{
    use HasFactory;
    use Searchable;
    use Builter;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'complaint_types';

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
