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
        $rules  =   [
                     'nombre' => 'required|min:3|max:50',
                     'semestres' => 'required',
                     'creditos' => 'required',
                     'escuela' => 'required|min:3|max:30',
                     'director' => 'required|min:3|max:15',
                    ];
        if (!$this->has('post_id')){
            $rules += ['codigo'=> 'required|min:2|max:15|unique:programa'];
        }
        return $rules;
    }
}
