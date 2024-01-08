<?php

namespace Modules\Meta\Eloquent;

use Modules\Meta\Entities\MetaData;

trait HasMetaData
{
    /**
     * The "booting" method of the trait.
     *
     * @return void
     */
    public static function bootHasMetaData()
    {
        static::saved(function ($entity) {
            $meta = request('meta', []);
            if(($entity->table == "products")){
                if( !$meta['meta_title']){
                    $meta['meta_title'] = request('name', '');
                }
                if(!$meta['meta_description']){
                    $des = request('description', '');
                    $meta['meta_description'] = $entity->generateShortDescription($des);
                }
            }
            $entity->saveMetaData($meta);
        });
    }

    private function generateShortDescription($content, $maxLength = 150) {
        // Loại bỏ các thẻ HTML (ảnh, v.v.)
        $strippedContent = strip_tags($content);

        // Cắt chuỗi theo số ký tự mong muốn
        $shortDescription = mb_substr($strippedContent, 0, $maxLength);

        // Đảm bảo không cắt giữa một từ
        $lastSpace = mb_strrpos($shortDescription, ' ');
        $shortDescription = mb_substr($shortDescription, 0, $lastSpace);

        return $shortDescription;
    }


    /**
     * Get the meta for the entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function meta()
    {
        return $this->morphOne(MetaData::class, 'entity')->withDefault();
    }

    /**
     * Save meta data for the entity.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveMetaData($data = [])
    {
        $this->meta->fill([locale() => $data])->save();
    }
}
