<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


  /*  public function purchaseOrders(): HasMany
    {
        return $this->hasMany('purcharse_order_products' , 'purchase_order_id', 'product_id');
    }
*/
}
