<?php

namespace App\Http\Requests\Admin\Sucursal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateSucursal extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.sucursal.edit', $this->sucursal);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'apertura' => ['nullable', 'date_format:H:i:s'],
            'cierre' => ['nullable', 'date_format:H:i:s'],
            'nombre' => ['sometimes', 'string'],
            'direccion' => ['sometimes', 'string'],
            'telefono' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('Sucursal', 'email')->ignore($this->sucursal->getKey(), $this->sucursal->getKeyName()), 'string'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
