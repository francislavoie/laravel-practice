<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    const ADMIN = 1;
    const PUBLISHER = 2;
    const PUBLIC_USER = 3;
}
