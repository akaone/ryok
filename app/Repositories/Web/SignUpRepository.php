<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class SignUpRepository
{
    /**
     * Sign up a new user
     * @param $data
     * @param $email_link
     * @return \App\Models\User
     */
    public function newMemberUser($data, $email_link)
    {
        $id = Uuid::generate()->string;

        DB::table('users')
            ->insert([
                'id' => $id,
                'email' => $data['email'],
                'email_link' => $email_link,
                'name' => $data['name'],
                'password' => bcrypt($data['password']),
                'gender' => $data['gender'],
                'state' => 'EMAIL',
            ])
        ;

        return DB::table('users')->where('id', $id)->first();
    }

    /**
     * Get a user email from his ID
     * @param $userId
     * @return string
     */
    public function getEmailFromId($userId)
    {
        $id = Uuid::generate()->string;

        $user = DB::table('users')->where([ 'id' => $userId ])->select('email')->first();
        return $user->email;
    }
}
