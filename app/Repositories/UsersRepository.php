<?php namespace App\Repositories;

use App\Services\ImageUploader;
use App\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UsersRepository extends Repository
{
    /**
     * Create new user
     *
     * @param array $data
     * @param User $user
     *
     * @return static
     */
    public function createOrUpdateCustomer(array $data = [], User $user = null)
    {
        // check if user exists
        if (! ($user && $user->exists)) {
            $user = $this->createModel();
        }

        $user->fill(array_merge($data, [
            'email'      => $this->prepareEmail($data),
            'birth_date' => $this->prepareDate($data),
        ]));

        // @todo: upload image
        if (isset($data['image']) && ($image = $data['image']) && $image instanceof UploadedFile) {
            (new ImageUploader)->upload($image, function ($file) use ($user) {
                $user->fill([
                    'image' => $file
                ]);
            });
        }
        $user->save();

        return $user;
    }

    /**
     * Prepare email for saving
     *
     * @param $data
     *
     * @return null|string
     */
    private function prepareEmail($data)
    {
        if (isset($data['email']) && ! empty($email = trim($data['email']))) {
            return $email;
        }

        return null;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function prepareDate(array $data)
    {
        return Carbon::parse(join('-',
            [$data['birth_date']['year'], $data['birth_date']['month'], $data['birth_date']['day']]))->toDateString();
    }

    /**
     * Find any user by column
     *
     * @param $value
     *
     * @param string $key
     * @return mixed
     */
    public function findAny($value, $key = 'id')
    {
        $query = $this->createModel()->withTrashed();

        $query->where($key, $value);

        return $query->first($this->defaultColumns());
    }

    /**
     * @return array
     */
    protected function defaultColumns()
    {
        return ['id', 'name', 'email', 'phone', 'birth_date', 'image', 'deleted_at'];
    }

    /**
     * Find user by name
     *
     * @param $value
     *
     * @param string $key
     * @return mixed
     */
    public function find($value, $key = 'id')
    {
        $query = $this->createModel()->member();

        $query->where($key, $value);

        return $query->first($this->defaultColumns());
    }

    /**
     * Search customer by name, email, etc...
     *
     * @param $value
     * @param string $key
     * @return mixed
     */
    public function search($value, $key = 'name')
    {
        return $this->createModel()->where($key, 'LIKE', "%{$value}%")->get($this->defaultColumns());
    }

    /**
     * @param $image
     *
     * @return string
     */
    protected function getTargetFileName($image)
    {
        $hash = md5_file($image->getRealPath());
        $ext = $image->getClientOriginalExtension();
        $file = "{$hash}.{$ext}";

        return $file;
    }
}