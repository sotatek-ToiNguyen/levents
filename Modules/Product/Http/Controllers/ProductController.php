<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Styling;
use Modules\Product\Entities\StylingToData;
use Modules\Review\Entities\Review;
use Modules\Product\Entities\Product;
use Modules\Product\Events\ProductViewed;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Middleware\SetProductSortOption;

class ProductController extends Controller
{
    use ProductSearch;

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
     * Display a listing of the resource.
     *
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        return view('public.products.index');
    }

    public function crew(Product $model, ProductFilter $productFilter)
    {
        $products = DB::select("SELECT * FROM products 
         join entity_files on products.id = entity_files.entity_id and entity_files.zone = 'crew_image'
        join files  on files.id = entity_files.file_id
        where products.is_active = true
        ");
        return view('public.crew.index', compact('products'));
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $review = $this->getReviewData($product);

        event(new ProductViewed($product));

        return view('public.products.show', compact('product', 'relatedProducts', 'upSellProducts', 'review'));
    }

    private function getReviewData(Product $product)
    {
        if (! setting('reviews_enabled')) {
            return;
        }

        return Review::countAndAvgRating($product);
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function stylingList()
    {
        $page = Styling::orderBy('id', 'DESC')->get();
        return view('public.styling.list', compact(['page']));
    }

    /**
     * Show the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function stylingIndex($slug)
    {
        $page = Styling::where('slug', $slug)->first();
        $file = File::findOrFail($page->base_image_id);
        $fileIds = StylingToData::where('styling_id', $page->id)
            ->whereNotNull('file_id')->select('file_id')
            ->get();
        $files = File::whereIn('id', $fileIds)->get();
        $productIds = StylingToData::where('styling_id', $page->id)
            ->whereNotNull('product_id')->pluck('product_id')->toArray();;
        $productsSelect = Product::whereIn('id', $productIds)->get();
        return view('public.styling.show', compact(['page', 'file', 'files', 'productsSelect']));
    }
}
