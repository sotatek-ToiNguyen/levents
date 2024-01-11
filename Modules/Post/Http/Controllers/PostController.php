<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Media\Entities\File;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostToProduct;
use Modules\Product\Entities\Product;

class PostController  extends Controller
{
    public function list(){
        $collections = Post::select('posts.name', 'posts.id', 'posts.slug', 'files.*')
            ->join('files', 'posts.base_image_id', '=', 'files.id')
            ->limit(10)->get();
        return view('public.collection.list', compact(['collections']));
    }

    public function show($slug){
        $page = Post::where('slug', $slug)->first();
        $file = File::findOrFail($page->base_image_id);
        $productIds = PostToProduct::where('post_id', $page->id)
            ->whereNotNull('product_id')->pluck('product_id')->toArray();;
        $productsSelect = Product::whereIn('id', $productIds)->get();
        return view('public.collection.show', compact(['page', 'file', 'productsSelect']));
    }
}
