<?php

namespace SIU\Http\Requests;

use SIU\Http\Requests\Request;

class asignacionesRequest extends Request
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
        return ['idbarrio'=>'required',
            'fecha'=>'required',
            'hora'=>'required',
            'nombre'=>'required',
            'asignacion'=>'required',
            'lugar'=>'required',
            'lider1'=>'required',
            'lider2'=>'required',
            'lider3'=>'required',
            'user_id'=>'required'
        ];
    }
}
