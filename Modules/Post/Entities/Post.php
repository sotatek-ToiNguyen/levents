<?php

namespace Modules\Post\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'short_description',
        'slug',
        'base_image_id',
        'meta_title',
        'meta_description',
    ];


    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';


    public function files()
    {
        return $this->belongsTo(File::class, 'base_image_id');
    }

    public function postToProduct()
    {
        return $this->belongsToMany(PostToProduct::class, 'post_to_product', 'id', 'post_id');
    }
}
