<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\MassageResource;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 * @param UserRequest $request
 * @param ForgotPasswordRequest $request
 * @param ResetRequest $request
 */
class AuthController extends BaseController
{
    /**
     * @var UserRepository
     */
    private UserRepository $authRepository;

    /**
     * AuthController constructor.
     * @param UserRepository $authRepository
     */
    public function __construct(UserRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param UserRequest $request
     * @return Application|ResponseFactory|Response|object
     * POST:Function for created user
     */
    public function register(UserRequest $request)
    {
        $user = $this->authRepository->register($request->name, $request->email, $request->password);
        return $this->response(new UserResource($user))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response|object
     * POST:Function for login user
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;

            return $this->response(new UserResource($success))
                ->setStatusCode(Response::HTTP_OK);
        } else {
            return $this->response(new MassageResource('Unauthorised'))
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @return Application|ResponseFactory|Response|object
     * GET:Function for get user
     */
    public function getUser()
    {
        $getUser = $this->authRepository->getUser();
        return $this->response(UserResource::collection($getUser))->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|ResponseFactory|Response|object
     * POST:Function for update user
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->authRepository->updateUser($request->name, $request->password, $id);
        return $this->response(new UserResource($user))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param $id
     * @return Application|ResponseFactory|Response|object
     * DELETE:Function for delete user
     */
    public function delete($id)
    {
        $this->authRepository->delete($id);
        return $this->response(new MassageResource('User removed'))->setStatusCode(Response::HTTP_GONE);
    }

    /**
     * @return Application|ResponseFactory|Response|object
     * POST:Function for logout user
     */
    public function logout()
    {
        $this->authRepository->logout();
        return $this->response(new MassageResource('Logged out'))->setStatusCode(Response::HTTP_OK);
    }


    // public function sendVerificationEmail(Request $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return [
    //             'message' => 'Already Verified'
    //         ];
    //     }

    //     $request->user()->sendEmailVerificationNotification();

    //     return ['status' => 'verification-link-sent'];
    // }

    // public function verify(EmailVerificationRequest $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return [
    //             'message' => 'Email already verified'
    //         ];
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return [
    //         'message' => 'Email has been verified'
    //     ];
    // }

    /**
     * @param ForgotPasswordRequest $request
     * @return Application|ResponseFactory|Response|object
     * @throws ValidationException
     * POST:Function for forgot password user
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return $this->response(new MassageResource(__($status)))->setStatusCode(Response::HTTP_OK);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /**
     * @param ResetRequest $request
     * @return Application|ResponseFactory|Response|object
     * POST:Function for reset password user
     */
    public function reset(ResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return $this->response(new MassageResource('Password reset successfully'))->setStatusCode(Response::HTTP_OK);
        }

        return $this->response(new MassageResource(__($status)))->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
