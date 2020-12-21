<?php

namespace App\Repositories\Web;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class SignUpRepository
{
    /**
     * Sign up a new user
     * @param $data
     * @param $emailLink
     * @return User|Model|Builder|object
     * @throws Exception
     */
        public function newMemberUser($data, $emailLink)
    {
        $id = Uuid::generate()->string;
        $now = Carbon::now();

        return User::create([
            'id' => $id,
            'email' => $data['email'],
            'email_link' => $emailLink,
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
            'state' => 'EMAIL',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    /**
     * Get a user email from his ID
     * @param $userId
     * @return string
     */
    public function getEmailFromId($userId)
    {
        $user = DB::table('users')->where([ 'id' => $userId ])->select('email')->first();
        return $user->email;
    }

    /**
     * Verify email
     * @param $emailLink
     * @return bool
     * @throws Exception
     */
    public function verifyEmail($emailLink)
    {
        $now = Carbon::now();

        return DB::table('users')
            ->where('email_link', $emailLink)
            ->update([
                'email_verified' => true,
                'state' => 'ACTIVATED',
                'email_link' => Uuid::generate()->string,
                'updated_at' => $now,
            ]);
    }
}
