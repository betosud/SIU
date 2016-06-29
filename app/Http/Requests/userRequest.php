<?php

namespace SIU\Http\Requests;

use SIU\Http\Requests\Request;

class userRequest extends Request
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
        
        return [
            'idestaca'=>'required',
            'idbarrio'=>'required',
            'name'=>'required',
//            'email'=>'required|unique:users',
            'email'=>'required|unique:users,email',
            'password'=>'required|min:6',
            'llamamiento'=>'required',
            'perfil'=>'required|exists:catalogos,id'
        ];
    }
}
