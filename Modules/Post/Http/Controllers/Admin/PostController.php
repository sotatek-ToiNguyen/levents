<?php

namespace Modules\Post\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Modules\Media\Entities\File;
use Modules\Post\Entities\Post;
use Modules\Post\Entities\PostToProduct;
use Modules\Product\Entities\Product;

class PostController
{

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'post::posts.post';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'post::admin.post';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */

    public function index(){
        $posts = Post::orderBy('id', 'desc')->get();
        return view("post::admin.post.index", compact(['posts']));
    }

    public function create(){
        $products = Product::limit(10)->get();
        $file = new file;
        $files = [];
        return view("post::admin.post.create", ['file' => $file, 'files' => $files, 'products' => $products]);

    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request){
        try{
            $post = new Post();
            $post->name = $request->name;
            $post->base_image_id = $request['files']['base_image'];
            $post->description = $request->description;
            $post->meta_title = $request->meta_title ?? $request->name;
            $post->slug = $this->convertToSlug($request->name);
            $post->meta_description = $request->meta_description ?? $request->name;
            $post->save();
            // save data

            if($request['productid']){
                $dataProducts = $request['productid'];
                foreach($dataProducts as $product_id){
                    $postToData = new PostToProduct();
                    $postToData->post_id = $post->id;
                    $postToData->product_id = $product_id;
                    $postToData->save();
                }
            }
            return redirect('/admin/post');
        }catch (Exception $e){
            return redirect('/admin/post');
        }
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $products = Product::limit(10)->get();
        $file = File::findOrFail($post->base_image_id);
        $productIds = PostToProduct::where('post_id', $id)
            ->whereNotNull('product_id')->pluck('product_id')->toArray();;
        $productsSelect = Product::whereIn('id', $productIds)->get();
        return view("post::admin.post.create", ['file' => $file, 'products' => $products, 'post' => $post, 'productIds' => $productIds, 'productsSelect' => $productsSelect]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update($id, Request $request){
        try{
            $post= Post::find($id);
            $post->name = $request->name;
            $post->base_image_id = $request['files']['base_image'];
            $post->description = $request->description;
            $post->meta_title = $request->meta_title ?? $request->name;
            $post->meta_description = $request->meta_description ?? $request->name;
            $post->save();
            PostToProduct::where('post_id', $id)->delete();
            // save data
            if($request['productid']){
                $dataProducts = $request['productid'];
                foreach($dataProducts as $product_id){
                    $postData = new PostToProduct();
                    $postData->post_id = $id;
                    $postData->product_id = $product_id;
                    $postData->save();
                }
            }
            return redirect('/admin/post');
        }catch (Exception $e){
            return redirect('/admin/post');
        }
    }


    public function destroy($ids)
    {
        Post::whereIn('id', explode(',', $ids))->delete();
        PostToProduct::whereIn('post_id', explode(',', $ids))->delete();
    }


    function convertToSlug($string)
    {
        // Chuyển về chữ thường
        $string = strtolower($string);

        // Loại bỏ các ký tự đặc biệt và dấu
        $string = preg_replace('/[^a-z0-9\-]/', '-', $string);

        // Loại bỏ các ký tự `-` trùng nhau
        $string = preg_replace('/-+/', '-', $string);

        // Loại bỏ các ký tự `-` ở đầu và cuối chuỗi
        $string = trim($string, '-');
        return $string;
    }
}
