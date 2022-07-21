<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConst extends Model
{
    use HasFactory;

    public const USER_ID = 2;
    public const RELATED_DEVICE = 3;
    public const DEVICE_PER_PAGE = 6;
    public const DEVICE_PER_ADMIN_PAGE = 10;
    
    public const USER = 'user';
    public const SUPPERVISOR = 'admin';
    public const MY_MAIL = 'dinhnguyenkhanh210401@gmail.com';
}
