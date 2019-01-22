<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class BancosFormRequest extends Request
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
            //
        'codigo'=>'required|max:100',
        'nombre'=>'required|max:250',
        'numero'=>'required|max:250',
       // 'tipo'=>'required|max:2',
        ];
    }
}
