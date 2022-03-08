<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PermissionRole;
use App\Http\Traits\UseUuid;

class Role extends Model
{
    use UseUuid;
    
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}