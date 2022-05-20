<?php namespace App\Transformers;

use App\ConstitutionType;
use League\Fractal\TransformerAbstract;

class ConstitutionTransformer extends TransformerAbstract
{
    public function transform(ConstitutionType $constitution)
    {
        return [
            'id'    => $constitution->id,
            'name'  => $constitution->name,
            'image' => url($constitution->image)
        ];
    }
}