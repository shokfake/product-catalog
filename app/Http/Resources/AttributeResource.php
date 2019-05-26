<?php


namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @property mixed category
 * @property mixed id
 * @property mixed value
 * @property mixed attribute
 */
class AttributeResource extends Resource
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
            'product' => $this->product_id,
            'value' => $this->value,
            'name' => $this->attribute->name,
        ];
    }
}