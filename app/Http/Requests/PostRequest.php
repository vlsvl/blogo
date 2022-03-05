<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if ($this->has('published') && $this->get('published')) {
            $this->merge(['posted_at' => Carbon::now()]);
        } else {
            $this->merge(['posted_at' => null]);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
            'user_id' => 'integer|required|exists:users,id',
            'posted_at' => 'date|nullable',
        ];
    }
}
