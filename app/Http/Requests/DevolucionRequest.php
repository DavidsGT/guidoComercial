<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class DevolucionRequest extends Request
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
        'cantidad'=>'required',
        'articulo'=>'max:150',
            //
        ];
    }
}
