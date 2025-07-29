<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Xác nhận người dùng có quyền gửi request hay không.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các rule xác thực dữ liệu.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => 'required|min:5|max:255',
            'id_category'    => 'required|exists:categories,id',
            'id_subcategory' => 'required|exists:subcategories,id',
            'price'          => 'required|max:100',
            'area'           => 'required|numeric|min:1',
            'bedrooms'       => 'nullable|integer|min:0',
            'bathrooms'      => 'nullable|integer|min:0',
            'address'        => 'required|min:5|max:255',
            'project_name'   => 'nullable|max:255',
            'location'       => 'required|max:255',
            'map_link'       => 'required|url',
            'phone'          => 'required|max:20',
            'zalo_link'      => 'required|url',
            'thumbnail'      => 'required|string',
            'content'        => 'required|min:10',
            'id_client'      => 'required',
        ];
    }

    /**
     * Thông báo lỗi tuỳ chỉnh.
     */
    public function messages()
    {
        return [
            'required'  => ':attribute không được để trống.',
            'min'       => ':attribute phải có ít nhất :min ký tự.',
            'max'       => ':attribute không được vượt quá :max ký tự.',
            'numeric'   => ':attribute phải là số.',
            'integer'   => ':attribute phải là số nguyên.',
            'url'       => ':attribute phải là một đường dẫn hợp lệ.',
            'exists'    => ':attribute không tồn tại trong hệ thống.',
        ];
    }

    /**
     * Gán tên tiếng Việt cho các thuộc tính.
     */
    public function attributes()
    {
        return [
            'title'          => 'Tiêu đề bài viết',
            'id_category'    => 'Danh mục cha',
            'id_subcategory' => 'Danh mục con',
            'price'          => 'Giá bán',
            'area'           => 'Diện tích',
            'bedrooms'       => 'Phòng ngủ',
            'bathrooms'      => 'Phòng vệ sinh',
            'address'        => 'Địa chỉ cụ thể',
            'project_name'   => 'Tên dự án',
            'location'       => 'Khu vực',
            'map_link'       => 'Link bản đồ',
            'phone'          => 'Số điện thoại liên hệ',
            'zalo_link'      => 'Zalo liên hệ',
            'thumbnail'      => 'Ảnh đại diện',
            'images'         => 'Ảnh mô tả chi tiết',
            'content'        => 'Nội dung chi tiết',
            'id_client'      => 'Người đăng',
        ];
    }
}
