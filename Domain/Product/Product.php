<?php

namespace Domain\Product;

use Common\Date\DateHelper;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['moment'];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function getMomentAttribute()
    {
        return DateHelper::getMoment($this->created_at);
    }
}
