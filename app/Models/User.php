<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserType;
use App\Enums\UserStatus;
use App\Traits\ProfileUpdateTrait;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
     use  HasFactory, Notifiable, ProfileUpdateTrait;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profile_image',
        'user_type',
        'status',
        'last_login_at', 

    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'user_type' => UserType::class,
            'status' => UserStatus::class,
            'last_login_at' => 'datetime',
        ];
    }


    public function isAdmin()
    {
        return $this->user_type === UserType::ADMIN;
    }

    public function isClient()
    {
        return $this->user_type === UserType::CLIENT;
    }

    public function getProfileImageUrlAttribute()
    {
        return $this->profile_image 
            ? asset('storage/' . $this->profile_image)
            : asset('images/default-avatar.png');
    }

    public function assignedTexts()
    {
        return $this->belongsToMany(AssignedText::class, 'assigned_text_users', 'user_id', 'assigned_text_id');
    }



    
}



   
   

    
