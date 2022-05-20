<?php

namespace App;

use App\Contracts\Sluggable;
use App\Traits\Models\UserRelations;
use App\Traits\Models\UserScopes;
use Carbon\Carbon;
use GlideImage;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Terranet\Administrator\Repository;

class User extends Repository implements AuthenticatableContract, CanResetPasswordContract, Sluggable
{
    use SoftDeletes, UserScopes, UserRelations;

    const IMAGE_SIZE_AVATAR = '64x64';

    const IMAGE_SIZE_MEDIUM = '180x180';

    const IMAGE_SIZE_BIG = '800x800';

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['site_id', 'name', 'first_name', 'second_name', 'email', 'phone', 'birth_date', 'image', 'role', 'active', 'online', 'password', 'paid'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $casts = [
        'site_id' => 'int',
        'online' => 'bool'
    ];

    public function hasImage()
    {
        return ! empty($this->attributes['image']) && file_exists($this->imageRealPath());
    }

    /**
     * @return string
     */
    private function imageRealPath()
    {
        $sourcePath = str_replace(public_path(), '', config('laravel-glide.source.path'));
        $sourcePath = str_replace($sourcePath, '', $this->attributes['image']);

        return trim($sourcePath, '/');
    }

    public function imageUrl($size = self::IMAGE_SIZE_AVATAR, array $attributes = [])
    {
        if (! $this->attributes['image'])
            return '';

        $size = $this->validateSize($size);

        $attributes = $this->prepareGlideAttributes($size, $attributes);

        $imagePath = $this->imageRealPath();

        return GlideImage::load($imagePath, $attributes)->getUrl();
    }

    /**
     * @param $size
     * @return string
     */
    protected function validateSize($size)
    {
        if (! in_array($size, [static::IMAGE_SIZE_AVATAR, static::IMAGE_SIZE_BIG, static::IMAGE_SIZE_MEDIUM])) {
            return static::IMAGE_SIZE_AVATAR;
        }

        return $size;
    }

    /**
     * @param       $size
     * @param array $attributes
     * @return array
     */
    protected function prepareGlideAttributes($size, array $attributes)
    {
        list($w, $h) = explode('x', $size);

        return ['w' => $w, 'h' => $h, 'fit' => 'crop', 'crop' => 'top'] + array_except($attributes, ['w', 'h', 'fit', 'crop']);
    }

    /**
     * Get user's age
     *
     * @return int
     */
    public function age()
    {
        return Carbon::now()->diffInYears(Carbon::parse($this->birth_date));
    }

    /**
     * Is user SelfSigned
     *
     * @return bool
     */
    public function isOnline()
    {
        return (int) $this->online;
    }

    public function isDeleted()
    {
        return ! is_null($this->{$this->getDeletedAtColumn()});
    }

    /**
     * Check if user is of Member role
     *
     * @return bool
     */
    public function isMember()
    {
        return 'member' == $this->role;
    }

    /**
     * Check if user is of Instructor role
     *
     * @return bool
     */
    public function isInstructor()
    {
        return 'instructor' == $this->role;
    }

    /**
     * Check if user is of Admin role
     *
     * @return bool
     */
    public function isAdmin()
    {
        return 'admin' == $this->role;
    }

    /**
     * Check if user is of Manager role
     *
     * @return bool
     */
    public function isManager()
    {
        return 'manager' == $this->role;
    }

    /**
     * @return string
     */
    public function sluggify()
    {
        return str_slug($this->name, '_');
    }
}
