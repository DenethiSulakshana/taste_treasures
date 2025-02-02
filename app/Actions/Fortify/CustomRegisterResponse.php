<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{
    /**
     * Get the response for a successful registration.
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        // Redirect to home page after successful registration
        return redirect()->intended('/');
    }
}
