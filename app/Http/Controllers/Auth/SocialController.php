<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Models\User;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->stateless()->user();
            $github_id = $user->getID();
            $user_name = $user->getNickName();
            $img_path = $user->getAvatar();
            $email_address = $user->getEmail();

            // データベースに存在するユーザかチェックし、存在しなかったら追加
            $user_data = User::firstOrCreate([
                'github_id' => $github_id
            ],[
                'github_id' => $github_id,
                'user_name' => $user_name,
                'img_path' => $img_path,
                'email_address' => $email_address,
            ]);
            Auth::login($user_data, true);
            return redirect('/');

        } catch (Exception $e) {
            return redirect('/');
        }
    }

    // ログアウト処理
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}