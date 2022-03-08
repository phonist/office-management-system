<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Traits\UseUuid;

class User extends Authenticatable
{
    
    use UseUuid;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'f_name',
        'l_name',
        'dob',
        'marital_status',
        'country',
        'blood_group',
        'id_number',
        'religious',
        'photo',
        'gender',
        'terminate_status', 
        'remember_token',
        'facebook_id', 
        'google_id', 
        'github_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return ($this->role == 'admin');
    }

    public function hasRole(){
        return $this->role;
    }

    public static function login($request)
    {
        $remember = $request->remember;
        $email = $request->email;
        $password = $request->password;
        return (\Auth::attempt(['email' => $email, 'password' => $password], $remember));
    }

    public function avatar(){
        return $this->photo;
    }
}
