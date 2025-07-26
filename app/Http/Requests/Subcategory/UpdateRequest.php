<?php

namespace App\Http\Requests\Subcategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|min:3|max:255|unique:subcategories,name,' . $this->id,
            'icon'          => 'nullable|min:3|max:255',
            'id_category'   => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống',
            'min'       => ':attribute phải có ít nhất :min ký tự',
            'max'       => ':attribute không được vượt quá :max ký tự',
            'unique'    => ':attribute đã tồn tại',
            'exists'    => ':attribute không hợp lệ',
        ];
    }

    public function attributes()
    {
        return [
            'name'         => 'Tên danh mục con',
            'icon'         => 'Biểu tượng icon',
            'id_category'  => 'Danh mục cha',
        ];
    }
}
