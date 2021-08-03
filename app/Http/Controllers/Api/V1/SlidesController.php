<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Integer;

class SlidesController extends Controller
{
    /**
     * @param  Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'product_type' => ['required'],
            'category_id' => ['required'],
        ]);

        return new JsonResponse(
            Slide::whereCategoryId($request->input('category_id'))
                ->where('product_type' , '=' , $request->input('product_type'))
                ->orderBy('id' , 'desc')
                ->get()
        );
    }

}
