<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
    {   //VALIDACIONES:
        $rules = [
            'name'          => 'required',
            'slug'          => 'required|unique:posts,slug', //el slug es unico y para asegurarse se compara a las otras slugs de los otros posts, 
                                                            //Y esto se tiene que especificar para que no se compare con las slugs de categorias y tags
            'user_id'       => 'required|integer',
            'category_id'   => 'required|integer',
            'tags'          => 'required|array',
            'body'          => 'required',
            'status'        => 'required|in:DRAFT,PUBLISHED',            
        ];

        if($this->get('file')) //si hemos enviado una imagen en el campo file
            $rules = array_merge($rules, ['file'         => 'mimes:jpg,jpeg,png']);
            //solo permite los formatos del array a continuación
        return $rules;
    }
}
