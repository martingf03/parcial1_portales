<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'status',
        'total_price',
        'estimated_days',
        'problem_description',
        'scheduled_at',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'orders_have_services')
            ->withPivot('price')
            ->withTimestamps();
    }
}
