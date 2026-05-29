<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\SuperAdmin\Leave;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * MASS ASSIGNMENT
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * HIDDEN FIELDS
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * CASTS
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * RELATIONS
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
