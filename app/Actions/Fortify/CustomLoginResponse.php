<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class CustomLoginResponse implements LoginResponseContract
{
    /**
     * Get the response for a successful login.
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        // Redirect to the landing page after login
        return redirect()->intended('/');
    }
}
