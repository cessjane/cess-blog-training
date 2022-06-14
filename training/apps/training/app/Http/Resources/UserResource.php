<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_name' => $this->user_name,
            'role' => $this->role ? 'Admin' : 'User',
            'edit_url' => URL::route('users.edit', $this),
            'delete_url' => URL::route('users.destroy', $this),
            'created_at' => Carbon::parse($this->created_at)->format('M d, Y h:m:s A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('M d, Y h:m:s A'),
        ];
    }
}
