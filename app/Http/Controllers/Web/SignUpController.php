<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Webpatser\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Web\SignUpRepository;

class SignUpController extends Controller
{
    /**
     * @var SignUpRepository
     */
    protected $signUpRepository;

    public function __construct() {
        $this->signUpRepository = new SignUpRepository();
    }

    /**
     * Show the form for adding a new user.
     *
     */
    public function create()
    {
        return Inertia::render('SignUp/SignUpCreate');
    }

    /**
     * Store a newly created user in database.
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'min:3'],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'gender' => ['required', 'in:M,F'],
        ]);

        $data = $request->except(['confirm_password']);

        $createdUser = $this->signUpRepository->newMemberUser($data, Uuid::generate()->string);
        // todo: send email

        return redirect()->route('sign-up.done', ['userId' => $createdUser->id]);
    }

    /**
     * Page to display that email has been sent.
     *
     */
    public function done(Request $request, $user_id)
    {
        $email = $this->signUpRepository->getEmailFromId($user_id);
        return Inertia::render('SignUp/SignUpDone', ['email' => $email]);
    }

    /**
     * Verify the user email.
     *
     */
    public function update(Request $request, $emailLink)
    {
        $isVerified = $this->signUpRepository->verifyEmail($emailLink);
        return Inertia::render('SignUp/SignUpVerify', ['isVerified' => $isVerified]);
    }
}
