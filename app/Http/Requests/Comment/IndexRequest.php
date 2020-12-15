<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Core\IndexRequestInterface;

class IndexRequest extends FormRequest implements IndexRequestInterface
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
        return [];
        // return merge_array(self::DEFAULT_INDEX_RULES, [
        //     'user_logs' => 'required'

        // ]);
    }
}
