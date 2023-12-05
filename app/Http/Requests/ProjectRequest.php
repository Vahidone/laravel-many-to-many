<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:2|max:20',
            'description' => 'required|min:5',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072'
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Il titolo del progetto è obbligatorio',
            'title.min' => 'Il titolo del progetto deve avere almeno :min caratteri',
            'title.max' => 'Il titolo del progetto non può avere più di :max caratteri',
            'description.required' => 'La descrizione del progetto non può essere vuoto',
            'description.min' =>  'La descrizione del progetto deve avere almeno :min caratteri',
            'image.image' => 'Il formato dell\'immagine non è corretto',
            'image.mimes' => 'Il formato dell\'immagine deve essere compreso tra jpeg,png,jpg,gif,svg,webp',
            'image.max' => 'Il size dell\'immagine non deve superare 3 megabyte',

        ];
    }
}
