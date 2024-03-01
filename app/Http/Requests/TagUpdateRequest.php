<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


//todo lo mismo que en tagstorerequest
class TagUpdateRequest extends FormRequest
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
        return [
            'name' => 'required',
            'slug' => 'required|unique:tags,slug,' . $this->tag,
            //"haz que todos los slugs sean únicos   ^ = EXCEPTO el id actual"
            //esta última linea que hemos añadido basicamente sirve
            //para evitar que no se revise a si mismo a la hora de actualizar
            //cuando evalua todos los registros
            //y se crea que estamos repitiendo el tag
        ];
    }
}
