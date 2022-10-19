<?php

namespace App\Models\Admin;

use Validator;
// app includes
use App\Models\Admin\User;
use Illuminate\Support\Facades\Crypt;
/**
 * Querys for User Table
 */
class UserModel {

    /**
     * Get all users
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Users
     */
    public static function listUsers($paginate = 10, $search = null) {

        $user = User::query();

        return  $user->get();
    }

    /**
     * get a user by id
     * @param integer $user id from database
     * @return Object User FormUser
     */
    public static function getUser($idUser) {
        $user = User::find($idUser);

        return $user;
    }

    /**
     * get validator for users
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false) {
        if ($edit) {
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        } else {

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);
        }

        // 'reputationNotes',
        $niceNames = array(
            'name' => 'Name',
        );

        $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save user
     * @param type $data information from form
     * @return Object UserFormUser
     */
    public static function saveUser($data) {
        $user = User::find($data['id']);
        if ($user) {

            // $password =  Crypt::decryptString($user->password);
            if ($user->password != '') {
                $data['password'] = bcrypt($data['password']);
                $user->update($data);
            }
        } else {
            unset($data['id']);

            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        }
        return $user;
    }
}
