<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['title', 'description'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->users()->delete();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->select('users.id','name', 'email', 'status');
    }

    public function filterUsers()
    {
        return $this->belongsToMany(User::class)->select('users.id', 'name', 'email', 'status')->where('status', 1);
    }
}
