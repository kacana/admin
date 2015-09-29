<?php namespace App\Http\Requests;
use App\Http\Requests\Request;

class ProductRequest extends Request{

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
                return[];
            }
            case 'POST':
            {
                return [
                    'name'      => 'required|min:6|max:255',
                    'image'     => 'mimes:jpeg,bmp,png',
                    'price'     => 'required|numeric',
                    'sell_price'=> 'required|numeric',
                ];
            }
            default:break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
        ];
    }
}