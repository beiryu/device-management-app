<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const OPEN = 'open';
    public const LENT = 'lent';
    public const PENDING = 'pending';

    public function devices () {
        return $this->hasMany(Device::class);
    }
}
