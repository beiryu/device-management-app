<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'imgPath',
        'type_id',
        'status_id',
        'slug',
        'user_id'
    ];
    
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function status () {
        return $this->belongsTo(Status::class);
    }

    public function type () {
        return $this->belongsTo(Type::class);
    }

    public function users () {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
