<?php

namespace Modules\Product\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;

class StylingToData extends Model
{
    public $timestamps = false;
    protected $table = "styling_to_datas";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'styling_id',
        'product_id',
        'file_id',
    ];

    public function files()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
