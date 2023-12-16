<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PurcharseOrderProducts extends Pivot
{
    use HasFactory;

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class,  'id');
    }

}
