<?php

namespace App\Models;

use App\Models\Employee;
use Validator;
// app includes


class EmployeeModel {

    /**
     * Get all Employees
     * @param integer $paginate default value 10, quantity to be shown by pages, can be null
     * @param string $search value to be searched, can be null
     * @return Object Employees
     */
    public static function listEmployees($paginate = 10, $search = null) {

        $empl = Employee::query();
        $empl->whereNull('deleted_at');
        $empl->orderBy('name');
        if ($search) {
            $empl->where(function ($sbQuery) use ($search) {
                $sbQuery->where('name', 'LIKE', "%$search%");
            });
        }

        return $paginate ? $empl->paginate($paginate) : $empl->get();
    }

    /**
     * get a Employee by id
     * @param integer $employee id from database
     * @return Object Employee FormEmployee
     */
    public static function getEmployee($idEmployee) {
        $employee = Employee::find($idEmployee);
        return $employee;
    }

    /**
     * get validator for Employee
     * @param array $data information from form
     * @return Object Validator
     */
    public static function getValidator($data) {
        $validator = Validator::make($data, [
            'photo'         => ['image|max:2048'],
            'empl_rutafoto' => ['max:200'],
        ]);

        return $validator;
    }

}
