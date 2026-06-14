<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'category_id',
        'brand_id',
        'price',
        'image',
        'stock',
        'is_featured',
        'status',
    ];

    public function category(){
        return $this -> belongsTo(Category::class);
}

    public function brand(){
        return $this -> belongsTo(Brand::class);
}

    public function images(){
        return $this -> hasMany(ProductImage::class);
}

    public function getIsNewAttribute(){
        return $this -> created_at
                    -> diffInDays(now()) <=30;
}



}



