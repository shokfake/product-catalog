<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @property mixed category
 */
class ProductResource extends Resource
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
           'category' => $this->category->name,
           'user' => $this->category->user->name,
       ];
    }
}