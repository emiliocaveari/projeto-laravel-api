<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'nome' => 'required',
            'cpf' =>  'required|unique:paciente,cpf',
            'celular' => 'required',
        ];

        if ( $this->method() === 'PUT' ){

            //--ID by route params
            if (!isset($this->id)){
                $this->merge(['id'=>($this->route()->parameters()['paciente_id'] ?? null)]);
            }

            $rules = [
                'id'   => 'required',
                'nome' => 'nullable',
                'cpf' =>  "nullable|unique:paciente,cpf,{$this->id},id",
                'celular' => 'nullable',
            ];
        }

        return $rules;
    }
}
