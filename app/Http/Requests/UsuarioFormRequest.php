<?php

namespace proyectDs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'codigo' => 'required|min:5|max:15|unique:usuario',
                    'primer_nombre' => 'required|min:3|max:30',
                    'segundo_nombre' => 'max:30',
                    'primer_apellido' => 'required|min:3|max:30',
                    'segundo_apellido' => 'max:30',
                    'name' => 'required|min:5|max:30|unique:usuario',
                    'rol' => 'required',
                    'email' => 'required|email|max:50|unique:usuario',
                    'password' => 'required|min:5|max:200',
                ];
                break;
            case 'PATCH':
                return [
                    'primer_nombre' => 'required|min:3|max:30',
                    'segundo_nombre' => 'max:30',
                    'primer_apellido' => 'required|min:3|max:30',
                    'segundo_apellido' => 'max:30',
                    'password' => 'max:200',
                ];
                break;    
            
            default:
                # code...
                break;
        }
    }
}
