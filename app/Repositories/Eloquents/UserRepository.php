<?php

namespace App\Repositories\Eloquents;

use App\User;
use Auth;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{
    protected $users;

    public function __construct(User $users){
        $this->users = $users;
    }
    /**
     * Get all of the vendor for the given user.
     *
     * @param  Vendor  $vendor
     * @return Collection
     */
    public function getAuthId()
    {
        return Auth::user()->id;
    }
}