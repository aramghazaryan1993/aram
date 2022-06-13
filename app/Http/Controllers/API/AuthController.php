<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\MassageResource;
use App\Http\Requests\UserRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use InvalidArgumentException;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 */
class AuthController extends BaseController
{
    /**
     * 
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     * POST:Function for creationg user
     */
    public function register(UserRequest $request)
    {
        $user = $this->authRepository->register($request->name, $request->email, $request->password);
        return $this->response(new UserResource($user))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
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
     * 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function getUser()
    {
        $getUser = $this->authRepository->getUser();
        return $this->response(UserResource::collection($getUser))->setStatusCode(Response::HTTP_OK);
    }

    public function updateUser(UserRequest $request, $id)
    {
        $user = $this->authRepository->updateUser($request->name, $request->email, $request->password, $id);
        return $this->response(new UserResource($user))->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * 
     * @param int $id 
     * @return Application|ResponseFactory|Response 
     * @throws BindingResolutionException 
     * @throws InvalidArgumentException 
     */
    public function delete(int $id)
    {
        $this->authRepository->delete($id);
        return $this->response(new MassageResource('User removed'))
            ->setStatusCode(Response::HTTP_GONE);
    }
}
