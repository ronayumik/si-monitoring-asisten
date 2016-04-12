<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Set custom login path
     */
    protected $loginPath = '/login';

    /**
     * Set custom view login
     */
    protected $loginView = 'pages.auth.login';

    /**
     * Set custom username field
     */
    protected $username = 'username';

    /**
     * Set custom redirection after login success
     */
    protected $redirectTo = 'activity';

    /**
     * Set custom redirection after logout
     */
    protected $redirectAfterLogout = '/auth/login';

    /**
     * UserRepository dependency
     */
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @param   UserRepository Repository to access App\Models\User
     * @return  void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('guest', ['except' => 'getLogout']);
    }
}