<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $table = "services";

    protected $primaryKey = "id";

    protected $fillable = [
        'service_name',
        'description',
        'price',
        'category_id',
        'featured',
        'duration',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_have_services')
            ->withPivot('price')
            ->withTimestamps();
    }
}
