<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class IngresoFormRequest extends Request
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
        'idproveedor'=>'required',
        'tipo_comprobante'=>'required|max:20',
        'serie_comprobante'=>'required|max:10',
        'numero_comprobante'=>'required|max:20',
        'cantidad'=>'required',
        'precio_compra'=>'required',
         'precio_venta_normal'=>'required',
         'formapago'=>'required'
        ];
    }
}
