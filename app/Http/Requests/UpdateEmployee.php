<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UpdateEmployee extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Employee must be 18 year old
        $dt = new Carbon();
        $before = $dt->subYears(18)->format('Y-m-d');
        return [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'designation' => 'required',
            'manager_id' => 'exists:users,id',
            'date_of_birth' => 'required|date_format:Y-m-d|before:'.$before,
            'joining_date' => 'required|date_format:Y-m-d|before:'.date("Y-m-d"),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.regex' => 'Enter a valid name',
            'date_of_birth.date_format' => 'Birthdate format must be Y-m-d',
            'joining_date.date_format' => 'Joining date format must be Y-m-d',
            'date_of_birth.before' => 'Employee must be 18 year old',
            'joining_date.before' => 'Enter a valid date of joining',
        ];
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if(request()->is('api/*')){
            throw new HttpResponseException(
                response()->json(['errors' => $validator->errors()], 422)
            );
        } else {
            throw new ValidationException($validator);
        }
    }
}
