<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);
        $result['result'] = $this->getProfile($this->weight, $this->height);
        return $result;
    }

    private function getProfile($weight, $height) {
        $profile = $weight / pow($height, 2);

        if ($profile < 18.5) {
            $result = 'Magreza';
            $obesityLevel = 0;
        } else if ($profile < 25) {
            $result = 'Normal';
            $obesityLevel = 0;
        } else if ($profile < 30) {
            $result = 'Sobrepeso';
            $obesityLevel = 1;
        } else if ($profile < 40) {
            $result = 'Obesidade';
            $obesityLevel = 2;
        } else {
            $result = 'Obesidade Grave';
            $obesityLevel = 3;
        }

        return [
            'profile' => $profile,
            'result' => $result,
            'obesityLeval' => $obesityLevel
        ];
    }
}