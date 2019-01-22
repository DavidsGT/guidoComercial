<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class CategoriaFormRequest extends Request
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
            // reglas de validaciobn, nombre de objetos de formulario
        'nombre'=>'required|max:50',
        'descripcion'=>'max:250',
        ];
    }
}
