<?php

namespace App\Services;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class CustomDatabaseTokenRepository extends DatabaseTokenRepository
{

    /**
     * Create a new token record.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @return string
     */
    public function create(CanResetPasswordContract $user)
    {
        $this->deleteExisting($user);

        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $token = $this->createNewToken();

        $this->getTable()->insert(['email' => $user->email, 'login' => $user->login, 'token' => $this->hasher->make($token), 'created_at' => new Carbon]);

        return $token;
    }

    /**
     * Delete all existing reset tokens from the database.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @return int
     */
    protected function deleteExisting(CanResetPasswordContract $user)
    {
        return $this->getTable()
            ->where('email', $user->getEmailForPasswordReset())
            ->where('login', $user->login)
            ->delete();
    }
}