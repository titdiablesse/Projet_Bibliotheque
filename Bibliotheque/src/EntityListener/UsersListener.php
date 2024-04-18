<?php

namespace App\EntityListener;

use App\Entity\Users;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersListener
{
    private UserPasswordHasherInterface $hasher;
    
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(Users $user)
    {
        $this->encodePassword($user);
    }

    public function preUpdate(Users $user)
    {
        $this->encodePassword($user);
    }

    public function encodePassword(Users $user)
    {
        if($user->getPassword() === null) {
            return;
        }

        $hashedPassword = $this->hasher->hashPassword(
            $user,
            $user->getPassword()
        );

        $user->setPassword($hashedPassword);
        $user->setPlainPassword(null);
    }
}
