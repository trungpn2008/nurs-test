<?php

namespace App\Claims;

use CorBosman\Passport\AccessToken;

class AdminClaim
{
    public function handle(AccessToken $token, $next)
    {
//        dd($token);
//          $token->addClaim('my-claim', 'my custom claim data');
        return $next($token);
    }
}
