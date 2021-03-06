<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseController;
use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 * @param string $name
 * @param string $email
 * @param string $password
 * @param string $id 
 * @return User
 */
class UserRepository extends BaseController
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function register(string $name, string $email, string $password)
    {
        $user             = User::create(['name' => $name, 'email' => $email, 'password' => bcrypt($password)]);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name']  =  $user->name;
        $success['email'] =  $user->email;

        return $success;
    }

    /**
     * 
     * @return User 
     */
    public function getUser()
    {
        return User::all();
    }

    /**
     * 
     * @param string $name 
     * @param string $password 
     * @param string $id 
     * @return User 
     * @throws BindingResolutionException 
     */
    public function updateUser(string $name, string $password, string $id): User
    {
        $editUser = User::find($id);
        $editUser->name = $name;
        $editUser->password = bcrypt($password);
        $editUser->save();
        return $editUser;
    }

    /**
     * 
     * @param int $id 
     * @return User 
     */
    public function delete(int $id)
    {
        return User::where('id', $id)->delete();
    }

    /**
     * 
     * @return mixed 
     * @throws BindingResolutionException 
     */
    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
