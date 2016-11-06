<?php

namespace App\Http\Requests;

use App\CommunityLink;
use Illuminate\Foundation\Http\FormRequest;

class CommunityLinkForm extends FormRequest
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
            'channel_id'    => 'required|exists:channels,id',
            'title'         => 'required',
            'link'          => 'required'
        ];
    }

    public function persist()
    {
        CommunityLink::from(
            auth()->user()
        )->contribute($this->all());
    } 
}
