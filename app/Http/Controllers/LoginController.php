<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user);
            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){
                $saveUser = User::updateOrCreate([
                    'provider_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'username' => $user->getEmail(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt('12345678')
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'provider_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);
            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function regisuser(Request $data){
        User::create([
            'name' => $data['name'],
            'username' => $data['email'],
            'email' => $data['email'],
            'password' => bcrypt($data->password),
        ]);
        return view('homeuser');
    }
}
