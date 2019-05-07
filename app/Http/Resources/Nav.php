<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Nav extends Resource
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
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.1',
            'developer' => "Mr Ben"
        ];
    }
}
