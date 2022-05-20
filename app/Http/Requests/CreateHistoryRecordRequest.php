<?php

namespace App\Http\Requests;

class CreateHistoryRecordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'office_id'         => 'required',
            'target_id'         => 'required|exists:targets,id',
            //'created_at'        => 'required|array',
            //'purchased_at'      => 'required|array',
            'height'            => 'required|numeric',
            'current_weight'    => 'required|numeric',
            'target_weight'     => 'required|numeric',
            'bone_radius'       => 'required|in:' . join(',', range(11, 19, 1)),
            'figure_type_id'    => 'required|exists:figure_types,id',
            'talia1'            => 'required|numeric',
            'talia2'            => 'required|numeric',
            'talia3'            => 'required|numeric',
            'buttocks'          => 'required|numeric',
            'thigh1'            => 'required|numeric',
            'thigh2'            => 'required|numeric',
            'shoulders'         => 'required|numeric',
            'menstrual_cycle'   => 'required|array',
            'schedule'          => 'required|array'
        ];
    }

    protected function getValidatorInstance()
    {
        $factory = $this->container->make('Illuminate\Validation\Factory');

        if (method_exists($this, 'validator')) {
            return $this->container->call([$this, 'validator'], compact('factory'));
        }

        $validator = $factory->make(
            $this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attributes()
        );


        return $validator;
    }
}
