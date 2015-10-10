<?php namespace App\Http\Requests;
use App\Http\Requests\Request;
use Input;

class UserRequest extends Request{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name'  => 'required',
                    'email' => 'required|email|unique:users,id',
                    'password' => Input::has('user_id') ? '':'required|min:6|max:30',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required'     => 'Vui lòng nhập tên',
            'email.required'    => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min'      => 'Mật khẩu ít nhất 6 ký tự',
            'password.max'      => 'Mật khẩu lớn nhất 30 ký tự',
        ];
    }
}
