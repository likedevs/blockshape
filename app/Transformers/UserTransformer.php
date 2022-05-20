<?php namespace App\Transformers;

use App\User as UserModel;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['images'];

    /**
     * Transform User model to a presentable array
     *
     * @param UserModel $user
     * @return array
     */
    public function transform(UserModel $user)
    {
        return [
            'id'          => $user->id,
            'name'        => $user->name,
            'phone'       => $user->phone,
            'email'       => $user->email,
            'profile_url' => route('customer.show', ['customer' => $user]),
            'form_url'    => route('customer.form', [])
        ];
    }

    public function includeImages(UserModel $user)
    {
        return $this->item([
            'small'  => $user->imageUrl(UserModel::IMAGE_SIZE_AVATAR),
            'medium' => $user->imageUrl(UserModel::IMAGE_SIZE_MEDIUM),
            'big'    => $user->imageUrl(UserModel::IMAGE_SIZE_BIG),
        ], new ArrayTransformer);
    }
}