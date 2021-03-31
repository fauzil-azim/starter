<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptedPassword extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'encrypted_password'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
