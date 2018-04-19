<?php

namespace proyectDs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoFormRequest extends FormRequest
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
                    'codigo' => 'required|min:5|max:15|unique:curso',
                    'nombre' => 'required|min:3|max:45',
                     'creditos' => 'required|digits_between: 1,5',
                     'magistrales' => 'required|digits_between: 1,5',
                     'independientes' => 'required|digits_between: 1,15',
                     'validacion' => 'required|min:1|max:5',
                     'habilitacion' => 'required|min:1|max:5',
                     'semestre' => 'required|digits_between: 1,15',
                     'tipo' => 'required',
                     'programa' => 'required|min:3|max:15',
                ];
                break;
            case 'PATCH':
                return [
                    'nombre' => 'required|min:3|max:45',
                    'creditos' => 'required|digits_between: 1,5',
                    'magistrales' => 'required|digits_between: 1,5',
                    'independientes' => 'required|digits_between: 1,15',
                    'validacion' => 'required|min:1|max:5',
                    'habilitacion' => 'required|min:1|max:5',
                    'semestre' => 'required|digits_between: 1,15',
                    'tipo' => 'required',
                    'programa' => 'required|min:3|max:15',
                ];
                break;    
            
            default:
                # code...
                break;
        }
    }
}
