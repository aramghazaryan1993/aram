<?php

namespace App\Repositories;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
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

    public function updateUser(string $name, string $email, string $password, string $id)
    {
        $editUser = User::find($id);
        $editUser->name = $name;
        $editUser->email = $email;
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
}
