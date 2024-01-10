<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\Styling;
use Modules\Product\Http\Middleware\SetProductSortOption;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */

    public function showApi($slug)
    {
        $product =  Product::findByName($slug);
        return $product;
    }


    public function showStylingApi(){
        return Styling::select('styling.*', 'files.*')
            ->join('files', 'styling.base_image_id', '=', 'files.id')
            ->limit(10)->get();
    }
}
