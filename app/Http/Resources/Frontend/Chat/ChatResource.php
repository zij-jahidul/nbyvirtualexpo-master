<?php

namespace App\Http\Resources\Frontend\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id',
            'company_id',
            'stall_id',
            'user_id',
            'message',
            'chat_document',
        ];
    }
}
