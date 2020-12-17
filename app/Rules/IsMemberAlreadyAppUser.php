<?php

namespace App\Rules;

use App\Repositories\Web\AppsUsersRepository;
use App\Utils\FreshAppUser;
use Illuminate\Contracts\Validation\Rule;

class IsMemberAlreadyAppUser implements Rule
{

    protected $appId;
    protected $message = 'The validation error message.';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->appId = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $appsUsersRep = new AppsUsersRepository();
        $isMember = $appsUsersRep->isMemberAlreadyAppUser($value, $this->appId);

        if($isMember) {
            $this->message = trans('This user is already a member of your app.');
        }
        return !$isMember;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
