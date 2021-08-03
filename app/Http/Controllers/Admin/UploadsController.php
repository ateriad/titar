<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadsController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|mimes:mp4,jpeg,png|max:256000',
        ]);

        $content = $request->input('id');
        $content = explode('-', $content);

        $type = $content[0];
        $id = $content[1];
        $fileType = $content[2];

        $extension = $request->file('file')->extension();
        $fileName = $id. '-'. $fileType. '.'. $extension;
        $address = null;

        if ($type == 'products') {
            if (!is_dir(storage_path('app/fs1/products'))) {
                mkdir(storage_path('app/fs1/products'), 0777, true);
            }

            if (!is_dir(storage_path('app/fs1/products/'. $id % 1000))) {
                mkdir(storage_path('app/fs1/products/') . $id % 1000, 0777, true);
            }

            $request->file('file')->move(storage_path('app/fs1/products/'. $id % 1000 ), $fileName);
            $address = 'https://titar.ir/fs1/files/products/'. $id % 1000 . '/'. $fileName ;
        }

        if ($type == 'advertisements') {
            if (!is_dir(storage_path('app/fs1/advertisements'))) {
                mkdir(storage_path('app/fs1/advertisements'), 0777, true);
            }

            if (!is_dir(storage_path('app/fs1/advertisements/'. $id % 1000))) {
                mkdir(storage_path('app/fs1/advertisements/') . $id % 1000, 0777, true);
            }

            $request->file('file')->move(storage_path('app/fs1/advertisements/'. $id % 1000 ), $fileName);
            $address = 'https://titar.ir/fs1/files/advertisements/'. $id % 1000 . '/'. $fileName ;
        }

        return $address;
    }
}
