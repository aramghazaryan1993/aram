<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseController
{
    /**
     * Class UserRepository
     * @package App\Repositories
     * @param string $name
     * @param string $email
     * @param string $password
     */

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
     * @return Collection<mixed, User> 
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
     * @return mixed 
     * @throws BindingResolutionException 
     */
    public function updateUser(string $name, string $password, string $id)
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
     * @return mixed 
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
