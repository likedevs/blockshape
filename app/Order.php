<?php

namespace App;

use Terranet\Administrator\Repository;
use Terranet\VictoriaBank\VbRepository;

class Order extends Repository
{
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_DECLINED = 'declined';
    const STATUS_REFUND   = 'refund';

    const GATEWAY_QIWI = 'qiwi';
    const GATEWAY_VB = 'cc-vb';
    const GATEWAY_CASH = 'cash';

    protected $fillable = ['user_history_id', 'offer_id', 'gateway', 'order_id', 'details', 'period', 'discount', 'amount', 'status', 'expires_at', 'paid_at', 'valid', 'comand_id'];

    protected $casts = [
        'period'   => 'int',
        'amount'   => 'double',
        'details'  => 'json',
        'discount' => 'int'
    ];

    protected $dates = ['expires_at', 'paid_at'];

    public function scopeLinkedToRecord($query, UserHistory $record)
    {
        return $query->where('user_history_id', (int) $record->id);
    }

    public function scopeLinkedToUser($query, User $user)
    {
        return $query->join('user_history', function ($join) {
            $join->on('user_history_id', '=', 'user_history.id');
        })->where('user_id', (int) $user->id);
    }

    public function scopePaid($query)
    {
        return $query->where("orders.status", '=', static::STATUS_PAID);
    }

    /**
     * History relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userHistory()
    {
        return $this->belongsTo(UserHistory::class);
    }

    /**
     * Offer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function bankTransactions()
    {
        return $this->hasMany(VbRepository::class);
    }

    /**
     * Show real processed amount
     *
     * @return string
     */
    public function processedAmount()
    {
        return array_get($details = (array) $this->details, 'AMOUNT', 0) . ' ' . array_get($details, 'CURRENCY', 'MDL');
    }
}
