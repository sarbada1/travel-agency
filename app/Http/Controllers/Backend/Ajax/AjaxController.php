<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AjaxController extends Controller
{


    function ajaxFileManage(Request $request)
    {

        $tableName = $request->tableName;
        $id = $request->id;
        $type = $request->type;
        $columnName = $request->columnName ?? 'image';
        if ($type == 'get_file') {
            $exp = explode(',', $columnName);
            if (count($exp) > 1) {
                $findData = DB::table($tableName)->select($exp)->where('id', $id)->first();
                foreach ($exp as $key => $value) {
                    if (!$findData->$value) {
                        $findData->$value = url('icons/notfound.png');
                    } else {
                        $findData->$value = url($findData->$value);
                    }
                }
                return response()->json(['data' => $findData]);
            } else {
                $findData = DB::table($tableName)->select($columnName)->where('id', $id)->first();
                if (!$findData->$columnName) {
                    $findData->$columnName = url('icons/notfound.png');
                } else {
                    $findData->$columnName = url($findData->$columnName);
                }
                return response()->json(['data' => $findData]);
            }
        } else if ($type == 'delete_file') {
            $findData = DB::table($tableName)->select($columnName)->where('id', $id)->first();
            if ($findData->$columnName) {
                $this->deleteFile($findData->$columnName);
            }
            DB::table($tableName)->where('id', $id)->update([$columnName => ""]);
            return response()->json(['success' => 'File deleted successfully']);
        } else {
            $findData = DB::table($tableName)->select($columnName)->where('id', $id)->first();
            $uploadPath = 'uploads/' . $tableName;
            if ($findData->$columnName) {
                $this->deleteFile($findData->$columnName);
                $fileName = $this->customFileUpload($uploadPath, $request);
                DB::table($tableName)->where('id', $id)->update([$columnName => $fileName]);
                return response()->json(['success' => 'File uploaded successfully']);
            } else {
                $fileName = $this->customFileUpload($uploadPath, $request);
                DB::table($tableName)->where('id', $id)->update([$columnName => $fileName]);
                return response()->json(['success' => 'File uploaded successfully']);
            }
        }
    }
}
