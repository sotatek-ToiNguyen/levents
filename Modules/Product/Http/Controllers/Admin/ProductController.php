<?php

namespace Modules\Product\Http\Controllers\Admin;

use Http\Client\Exception;
use Illuminate\Http\Request;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Product\Entities\Styling;
use Modules\Product\Entities\StylingToData;
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
        $stylings = Styling::orderBy('id', 'desc')->get();
        return view("product::admin.styling.index", ['stylings' => $stylings]);
    }

    public function stylingCreate()
    {
        $products = Product::limit(10)->get();
        $file = new file;
        $files = [];
        return view("product::admin.styling.create", ['file' => $file, 'files' => $files, 'products' => $products]);
    }

    public function stylingEdit($id)
    {
        $styling = Styling::findOrFail($id);
        $products = Product::limit(10)->get();
        $file = File::findOrFail($styling->base_image_id);
        $fileIds = StylingToData::where('styling_id', $id)
            ->whereNotNull('file_id')->select('file_id')
            ->get();
        $files = File::whereIn('id', $fileIds)->get();
        $productIds = StylingToData::where('styling_id', $id)
            ->whereNotNull('product_id')->pluck('product_id')->toArray();;
        $productsSelect = Product::whereIn('id', $productIds)->get();
        return view("product::admin.styling.create", ['file' => $file, 'files' => $files, 'products' => $products, 'styling' => $styling, 'productIds' => $productIds, 'productsSelect' => $productsSelect]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function stylingUpdate($id, Request $request){
        try{
            $styling = Styling::find($id);
            $styling->name = $request->name;
            $styling->base_image_id = $request['files']['base_image'];
            $styling->description = $request->description;
            $styling->meta_title = $request->meta_title ?? $request->name;
            $styling->meta_description = $request->meta_description ?? $request->name;
            $styling->save();
            StylingToData::where('styling_id', $id)->delete();
            // save data
            if($request['productid']){
                $dataProducts = $request['productid'];
                foreach($dataProducts as $product_id){
                    $stylingData = new StylingToData();
                    $stylingData->styling_id = $id;
                    $stylingData->product_id = $product_id;
                    $stylingData->save();
                }
            }

            if($request['files']['library_images']){
                $dataFiles = $request['files']['library_images'];
                foreach($dataFiles as $file_id){
                    $stylingData = new StylingToData();
                    $stylingData->styling_id = $id;
                    $stylingData->file_id = $file_id;
                    $stylingData->save();
                }
            }
            return redirect('/admin/styling');
        }catch (Exception $e){
            return redirect('/admin/styling');
        }
    }


    public function stylingDestroy($ids)
    {
        Styling::whereIn('id', explode(',', $ids))->delete();
        StylingToData::whereIn('styling_id', explode(',', $ids))->delete();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function stylingSave(Request $request){
        try{
            $styling = new Styling();
            $styling->name = $request->name;
            $styling->base_image_id = $request['files']['base_image'];
            $styling->description = $request->description;
            $styling->meta_title = $request->meta_title ?? $request->name;
            $styling->slug = $this->convertToSlug($request->name);
            $styling->meta_description = $request->meta_description ?? $request->name;
            $styling->save();
            // save data
            if($request['productid']){
                $dataProducts = $request['productid'];
                foreach($dataProducts as $product_id){
                    $stylingData = new StylingToData();
                    $stylingData->styling_id = $styling->id;
                    $stylingData->product_id = $product_id;
                    $stylingData->save();
                }
            }

            if(isset($request['files']['library_images'])){
                $dataFiles = $request['files']['library_images'];
                foreach($dataFiles as $file_id){
                    $stylingData = new StylingToData();
                    $stylingData->styling_id = $styling->id;
                    $stylingData->file_id = $file_id;
                    $stylingData->save();
                }
            }
            return redirect('/admin/styling');
        }catch (Exception $e){
            return redirect('/admin/styling');
        }
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
