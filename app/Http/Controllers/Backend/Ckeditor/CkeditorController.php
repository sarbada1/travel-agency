<?php

namespace App\Http\Controllers\Backend\Ckeditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CkeditorController extends Controller
{

    public function index(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = md5(microtime()) . '.' . $extension;
            $request->file('upload')->move(public_path('/ckeditor-image'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/ckeditor-image/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
