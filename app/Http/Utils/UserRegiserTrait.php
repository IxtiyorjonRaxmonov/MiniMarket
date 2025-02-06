<?php

namespace App\Http\Utils;

trait UserRegiserTrait
{
    public function condtion($username)
    {
        if ($username == "abdulloh oka") {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }
}
