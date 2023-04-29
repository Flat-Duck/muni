<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Complaint extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
    use  InteractsWithMedia;

    protected $with = [
        "media",
        "user",
        "complaintType"
    ];

    protected $fillable = [
        'content',
        'user_id',
        'municipality_id',
        'complaint_type_id',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function complaintType()
    {
        return $this->belongsTo(ComplaintType::class);
    }

}
