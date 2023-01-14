<?php

namespace App\Http\Resources\Backend\Company;

use App\Models\User;
use App\Models\Company\Company;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed company_id
 * @property mixed user_id
 * @property mixed status
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed id
 */
class CompanyUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'company_id'   => $this->company_id, 
            'company_name' => Company:: find($this->company_id)->company_name,
            'user_id'      => $this->user_id,
            'user_name'      => User:: find($this->user_id)->name,
            'status'       => $this->status == 1? '<span class = "text-success">Active</span>': '<span class = "text-danger">Inactive</span>',
            'created_at'   => $this->created_at,
            'updated_at'   => $this->updated_at,
        ];
    }
}
