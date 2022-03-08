<?php

namespace App\Services;

use App\Repositories\Interfaces\IUserRepository;

class UserService {
    protected $users;

    public function __construct(IUserRepository $users){
        $this->users = $users;
    }

    public function getAuthId(){
        return $this->users->getAuthId();
    }
}