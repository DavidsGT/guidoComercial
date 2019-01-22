<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class InventarioRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'idcategoria'=>'required',
        'codigo'=>'required|max:50',
        'nombre'=>'required|max:100',
        'stock'=>'required|numeric',
         'stockmin'=>'required|numeric',
        'descripcion'=>'max:512',
        'imagen'=>'mimes:jpeg,bmp,png',
        ];
    }
}
