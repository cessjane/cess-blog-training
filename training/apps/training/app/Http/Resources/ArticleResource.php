<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class ArticleResource extends JsonResource
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
            'article_category_id' => $this->category->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'contents' => $this->contents,
            'image_path' => $this->image_path,
            'updated_user_id' => $this->user->first_name . " " . $this->user->last_name,
            'created_at' => Carbon::parse($this->created_at)->format('M d, Y h:m:s A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('M d, Y h:m:s A'),
            'edit_url' => URL::route('articles.edit', $this),
            'delete_url' => URL::route('articles.destroy', $this),
        ];
    }
}
