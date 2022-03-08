<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UseUuid;
class Permission extends Model
{
    use UseUuid;
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'user_id'
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
