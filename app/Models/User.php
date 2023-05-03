<?php

namespace App\Models;

use App\Models\Scopes\Builter;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use Builter;

    protected $fillable = [
        'name',
        'email',
        'password',
        'municipality_id',
        'phone',
        'birth_date',
        'gender',
        'nationality',
        'Identity',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'active' => 'boolean',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isDashboardUser()
    {
        return $this->roles->count() > 0;
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super-admin');
    }
}
