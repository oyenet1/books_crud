<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fortify::authenticateUsing(function (Request $request) {
        //     $login = $request->username;
        //     if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        //         $user = User::where('email', $login)->first();
        //     } else {
        //         $user = User::where('library_id', $login)->first();
        //     }

        //     if ($user && Hash::check($request->password, $user->password)) {
        //         return $user;
        //     }
        // });

        // customized login
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('username', $request->email)
                ->orWhere('email', $request->email)
                ->first();
            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            }
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // login view
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });

        // send password reset link
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forget-password');
        });
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', compact('request'));
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
