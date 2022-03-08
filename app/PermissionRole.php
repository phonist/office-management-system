<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class PermissionRole extends Model
{
    use UseUuid;
    public $timestamps = false;
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id',
        'role_id'
    ];
}
