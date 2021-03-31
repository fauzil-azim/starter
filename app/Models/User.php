<?php

namespace App\Models;

use App\Models\EncryptedPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    protected $appends = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function encrypted()
    {
        return $this->hasOne(EncryptedPassword::class, 'user_id', 'id');
    }

    public function unverify() {
        $this->email_verified_at = null;
        $this->save(['timestamps' => false]);
    }

    public function getTanggalBergabungAttribute() {
        return $this->created_at->format('d-m-Y');
    }

}
