<?php

namespace App;

use App\Contracts\Sluggable;
use App\Events\DocumentProcessed;
use App\Traits\Models\DescOrders;
use Carbon\Carbon;
use Event;
use Terranet\Administrator\Repository;

class UserHistory extends Repository implements Sluggable
{
    use DescOrders;

    const STATUS_PENDING = 'pending';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_DECLINED = 'declined';

    protected $table = 'user_history';
    protected $constitution = null;
    protected $fillable = [
        'office_id',
        'instructor_id',
        'target_id',
        'workout',
        'height',
        'current_weight',
        'target_weight',
        'bone_radius',
        'figure_type_id',
        'talia1',
        'talia2',
        'talia3',
        'buttocks',
        'thigh1',
        'thigh2',
        'shoulders',
        'pulse3',
        'pressure_rest',
        'pressure_load',
        'pressure_type_id',
        'menstrual_cycle',
        'other_diseases',
        'other_allergies',
        'other_excludes',
        'schedule',
        'document',
        'status',
        'declineReason',
        'created_at',
        'purchased_at',
        'accepted_at'
    ];
    protected $dates = ['purchased_at', 'accepted_at'];

    protected $casts = [
        'pressure_rest' => 'json',
        'pressure_load' => 'json',
        'menstrual_cycle' => 'json',
        'schedule' => 'json',
        'height' => 'int',
        'current_weight' => 'double',
        'target_weight' => 'double',
        'bone_radius' => 'int',
        'talia1' => 'double',
        'talia2' => 'double',
        'talia3' => 'double',
        'pulse3' => 'int',
        'buttocks' => 'double',
        'thigh1' => 'double',
        'thigh2' => 'double',
        'shoulders' => 'double'
    ];

    public function scaffoldingQuery()
    {
        return $this->_buildIndexQuery();
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    protected function priority($default = 10)
    {
        $priority = null;

        if ($order = $this->order) {
            $priority = $order->offer->period;
        }

        return $priority ? : $default;
    }

    /**
     * Priority for record processing
     *
     * @return array
     */
    public function priorityPeriod()
    {
        if ($priority = $this->priority()) {
            return trans('result.priority', ['priority' => $priority]);
        }

        return trans('result.no_priority');
    }

    public function deadlineExpired()
    {
        return Carbon::now()->gt($this->deadline());
    }

    /**
     * Deadline: date until the record should be processed
     *
     * @return Carbon
     */
    public function deadline()
    {
        $from = $this->purchased_at ? : $this->created_at;

        return $from->addDays($this->priority());
    }

    public function highPriority()
    {
        return $this->priority() == 2;
    }

    /**
     * Limit by user
     *
     * @param $query
     * @param User $user
     */
    public function scopeOfUser($query, User $user)
    {
        return $query->where('user_id', (int) $user->id);
    }

    /**
     * Limit by instructor
     *
     * @param $query
     * @param User $instructor
     */
    public function scopeByInstructor($query, User $instructor)
    {
        return $query->where('instructor_id', (int) $instructor->id);
    }

    public function scopeFull($query)
    {
        return $query->with(['target', 'user', 'instructor', 'office', 'figureType', 'pressureType', 'excludes', 'diseases', 'allergies', 'quizPairs']);
    }

    public function target()
    {
        return $this->belongsTo(Target::class);
    }

    /**
     * Get record created date
     *
     * @return mixed
     */
    public function date()
    {
        return $this->purchased_at ? : $this->created_at;
    }

    /**
     * Get record acceptance date
     *
     * @return mixed
     */
    public function confirmedAt()
    {
        return $this->accepted_at;
    }

    /**
     * Approve record
     *
     * @throws \Exception
     */
    public function approve()
    {
        $this->setStatus(static::STATUS_CONFIRMED);
        $this->save();

        // Push confirmed event
        Event::fire(new DocumentProcessed($this));
    }

    public function setStatus($status)
    {
        if (! in_array($status, [static::STATUS_CONFIRMED, static::STATUS_PENDING, static::STATUS_DECLINED])) {
            throw new \Exception('Unknown status: ' . $status);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Check for confirmation status
     *
     * @return bool
     */
    public function confirmed()
    {
        return static::STATUS_CONFIRMED == $this->status;
    }

    /**
     * Decline
     *
     * @param null $reason
     * @throws \Exception
     */
    public function decline($reason = null)
    {
        $this->setStatus(UserHistory::STATUS_DECLINED);
        $this->declineReason = $this->declineReason . ($reason ? "\n{$reason}" : '');

        $this->save();

        // Push confirmed event
        Event::fire(new DocumentProcessed($this));
    }

    /**
     * Check for declined status
     *
     * @return bool
     */
    public function declined()
    {
        return static::STATUS_DECLINED == $this->status;
    }

    public function hasDocument()
    {
        return ! is_null($this->document);
    }

    /**
     * Customer that  history belongs to
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(array $columns = ['id', 'site_id', 'name', 'email', 'phone', 'birth_date', 'image', 'online'])
    {
        return $this->belongsTo(User::class)->select($columns)->withTrashed();
    }

    /**
     * Instructor created history record
     *
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instructor(array $columns = ['id', 'name'])
    {
        return $this->belongsTo(User::class, 'instructor_id')->select($columns)->withTrashed();
    }

    /**
     * Reference to Figure type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function figureType()
    {
        return $this->belongsTo(FigureType::class);
    }

    public function constitutionType()
    {
        if (null === $this->constitution) {
            $this->constitution = ConstitutionType::where('bone_min', '<=', $this->bone_radius)->where('bone_max', '>=',
                $this->bone_radius)->first();
        }

        return $this->constitution;
    }

    public function pressureType()
    {
        return $this->belongsTo(PressureType::class);
    }

    /**
     * Office, where record has been created
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Diseases indicated by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'user_history_diseases', 'history_id', 'disease_id');
    }

    /**
     * Allergies indicated by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'user_history_allergies', 'history_id', 'allergy_id');
    }

    /**
     * Food excludes indicated by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function excludes()
    {
        return $this->belongsToMany(FoodExcludes::class, 'user_history_excludes', 'history_id', 'exclude_id');
    }

    /**
     * Quiz Questions and Answers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function quizPairs()
    {
        return $this->hasMany(UserHistoryQuizAnswer::class, 'history_id')->with(['question', 'answer']);
    }

    public function sluggify()
    {
        return str_slug($this->created_at->format('d M, Y'), '_');
    }

    public function isFloatCycle()
    {
        $cycle = $this->menstrual_cycle;

        if (array_key_exists('duration', $cycle) && in_array($cycle['duration'], [-1, -2])) {
            return true;
        }

        // support for old markup
        if (array_key_exists('float', $cycle) && !! $cycle['float']) {
            return true;
        }

        return false;
    }

    public function isMenoPause()
    {
        return array_key_exists('menopause', $this->menstrual_cycle) && (bool) $this->menstrual_cycle['menopause'];
    }

    public function canRebuild()
    {
        return $this->pending();
    }

    /**
     * Check for pending status
     *
     * @return bool
     */
    public function pending()
    {
        return static::STATUS_PENDING == $this->status;
    }
}
