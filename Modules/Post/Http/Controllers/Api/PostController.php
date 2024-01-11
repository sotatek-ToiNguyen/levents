<?php

namespace Modules\Post\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\File;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostToProduct;
use Modules\Product\Entities\Product;

class PostController  extends Controller
{
    public function getPost(){
        return Post::select('posts.name', 'posts.id', 'posts.slug', 'files.*')
            ->join('files', 'posts.base_image_id', '=', 'files.id')
            ->limit(10)->get();
    }
}
