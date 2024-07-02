<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //     'title' => 'required|min:10|max:200',
    //     'subtitle' => 'required|min:10|max:200',
    //     'price' => 'required',
    //     'body' => 'required|min:25',
    //     'category' => 'required',        
    //     ];
    // }
    // public function messages(){
    //     return [
    //     'title.required' => 'Il titolo è richiesto',
    //     'title.min' => 'Il titolo è troppo corto',
    //     'title.max' => 'Il titolo è troppo lungo',
    //     'subtitle.required' => 'Il sottotitolo è richiesto',
    //     'subtitle.min' => 'Il sottotitolo è troppo corto',
    //     'subtitle.max' => 'Il sottotitolo è troppo lungo',
    //     'body.required' => 'Il corpo dell\'articolo è richiesto',
    //     'body.min' => 'Il corpo dell\'articolo è troppo corto',
    //     'price.required' => 'Devi inserire il prezzo',
    //     'category.required' => 'Devi inserire la categoria'
        
    //     ];
    //     }
        
}
