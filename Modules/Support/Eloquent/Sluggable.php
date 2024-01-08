<?php

namespace Modules\Support\Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;

trait Sluggable
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::creating(function ($entity) {
            $entity->setSlug();
        });
    }

    /**
     * Set the slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function setSlug($value = null)
    {
        if (is_null($value)) {
            $value = $this->getAttribute($this->slugAttribute);
        }
        $slug =  $this->generateSlug($value);
        if(strlen($slug) > 41){
            $firstPart = substr($slug, 0, 41);
            $remainingPart = md5(substr($slug, 42) . time());
            $slug = $firstPart . $remainingPart;
        }
        $this->attributes['slug'] = $slug;
    }

    /**
     * Generate slug by the given value.
     *
     * @param string $value
     * @return string
     */
    private function generateSlug($value)
    {
        $slug = str_slug($value) ?: slugify($value);

        $query = $this->where('slug', $slug)->withoutGlobalScope('active');

        if (array_has(class_uses($this), SoftDeletes::class)) {
            $query->withTrashed();
        }

        if ($query->exists()) {
            $slug .= '-' . str_random(8);
        }

        return $slug;
    }
}
