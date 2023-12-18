<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PurchaseOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class )->using(PurcharseOrderProducts::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class , 'id');
    }

}
