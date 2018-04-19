<?php

namespace proyectDs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaFormRequest extends FormRequest
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
                     'codigo'=> 'required|min:2|max:15|unique:programa',
                     'nombre' => 'required|min:3|max:50',
                     'semestres' => 'required',
                     'creditos' => 'required',
                     'escuela' => 'required|min:3|max:30',
                     'director' => 'required|min:3|max:15|unique:programa',
                ];
                break;
            case 'PATCH':
                return [
                     //'codigo'=> 'required|min:2|max:15|unique:programa',
                     'nombre' => 'required|min:3|max:50',
                     'semestres' => 'required',
                     'creditos' => 'required',
                     //'escuela' => 'required|min:3|max:30',
                     //'director' => 'required|min:3|max:15|unique:programa',
                ];
                break;    
            
            default:
                # code...
                break;
        }
    }
}
