<?php

namespace Modules\Product\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Product\Entities\Styling;
use Modules\Product\Http\Requests\SaveProductRequest;

class ProductController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'product::products.product';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'product::admin.products';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveProductRequest::class;

    public function stylingIndex(Request $request)
    {
        $stylings = Styling::all();
        return view("product::admin.styling.index", ['stylings' => $stylings]);
    }
    public function stylingCreate()
    {
        $products = Product::limit(10)->get();
        $file = new file;
        $files = [];
        return view("product::admin.styling.create", ['file' => $file, 'files' => $files, 'products' => $products]);
    }

}
