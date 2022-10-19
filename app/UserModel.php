<?php
namespace App;
use Validator;
// app includes
use App\User;

/**
 * Querys for User Table
 */
class UserModel
{

    /**
     * Get all users
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Users
     */
    public static function listUser($paginate = 10, $search = null)
    {

        $user = User::query();
        // $user->whereNull('deleted_at');
        // $user->orderBy('name');
        // if ($search) {
        //     $user->where(function ($sbQuery) use ($search) {
        //         $sbQuery->where('name', 'LIKE', "%$search%");
        //     });
        // }

        return $user->orderBy('id','DESC')->get();
    }

    /**
     * get a user by id
     * @param integer $user id from database
     * @return Object User FormUser
     */
    public static function getUser($idUser)
    {
        $user= User::find($idUser);

        return $user;
    }

    /**
     * get validator for users
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data, $edit = false)
    {

                // 'reputationNotes',
                $niceNames = array(
                    'name.required' => 'El nombre es requerido',
                    'name.string' => 'El nombre debe ser una cadena de texto',
                );
        
        if($edit){
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ],$niceNames);
        }else{

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6'],
            ],$niceNames);

        }


        // $validator->setAttributeNames($niceNames);

        return $validator;
    }

    /**
     * save user
     * @param type $data information from form
     * @return Object UserFormUser
     */
    public static function saveUser($data)
    {
        $user=User::find($data['idUser']);
        if ($user) {
            $user->update($data);
        } else {
            $user= User::create($data);
        }
        return $user;
    }
}
