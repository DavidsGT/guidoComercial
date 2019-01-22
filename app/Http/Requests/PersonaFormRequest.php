<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;


class PersonaFormRequest extends Request
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
            // reglas de validacion
        'nombre'=>'required|max:100',
        'tipo_documento'=>'required|max:20',
        'numero_documento'=>'required|max:15',
        'direccion'=>'max:70',
        'telefono'=>'required|max:10',
        'email'=>'max:50',
        //'cedularepresenta'=>'required|max:15',
        'representante'=>'max:100',
       // 'telefonorepresenta'=>'required|max:105'
        ];
    }
}
