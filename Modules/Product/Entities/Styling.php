<?php

namespace Modules\Product\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;

class Styling extends Model
{
    protected $table = "styling";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'base_image_id',
        'description',
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

    public function stylingToData()
    {
        return $this->belongsToMany(StylingToData::class, 'styling_to_data', 'id', 'styling_id');
    }
}
