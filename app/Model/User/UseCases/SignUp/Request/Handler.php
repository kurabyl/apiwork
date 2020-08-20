<?php
namespace App\Model\User\UseCases\SignUp\Request;

use App\Model\User\Entity\User;
use Illuminate\Support\Facades\Hash;

class Handler
{

    public function handle($requests)
    {
       $user = User::create([

           'name'=>$requests->name,
           'email'=>$requests->email,
           'phone'=>$requests->phone,
           'city'=>$requests->city,
           'birthday'=>$requests->birthday,
           'password'=>Hash::make($requests->password)
       ]);

       $token = auth()->login($user);

       return $token;
    }
}
