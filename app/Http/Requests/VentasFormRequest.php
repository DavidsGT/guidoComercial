<?php

namespace comercial\Http\Requests;

use comercial\Http\Requests\Request;

class VentasFormRequest extends Request
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
        'idcliente'=>'required',
        'tipo_comprobante'=>'required|max:20',
        'serie_comprobante'=>'max:7',
        'numero_comprobante'=>'required|max:10',
        'idarticulo'=>'required',
        'cantidad'=>'required',
        'precio_venta'=>'required',
        'total_pagar'=>'required',
        
        ];
    }
}
