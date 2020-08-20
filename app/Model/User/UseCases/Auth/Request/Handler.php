<?php
namespace App\Model\User\UseCases\Auth\Request;

class Handler
{

    public function handle($requests)
    {
        $credentials = $requests->only(['email', 'password']);
        $token = auth()->attempt($credentials);

        if ($token) {
            return $token;
        }

        return false;
    }
}
