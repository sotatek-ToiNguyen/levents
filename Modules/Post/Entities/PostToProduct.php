<?php

namespace Modules\Post\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;

class PostToProduct extends Model
{
    public $timestamps = false;
    protected $table = "post_to_product";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'post_id',
        'product_id',
    ];
}
