<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed category
 */
class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'id' => $this->id,
           'name' => $this->name,
           'image' => $this->image,
           'category' => $this->category->name,
           'attributes' =>  AttributeResource::collection($this->attributes),
           'user' => $this->category->user->name,
       ];
    }
}