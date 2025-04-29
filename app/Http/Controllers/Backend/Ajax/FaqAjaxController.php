<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\Page;
use App\Models\Address\Country;
use Illuminate\Support\Facades\DB;

class FaqAjaxController extends Controller
{
    function ajaxFaqManage(Request $request)
    {
        $tableName = $request->tableName;
        $prentId = $request->parentId;
        $type = $request->type;
        $faqModelMapping = [
            'pages' => Page::class,
            'countries' => Country::class,
        ];

        if (!isset($faqModelMapping[$tableName])) {
            return response()->json(['error' => "FAQ model not defined for table '$tableName'"], 404);
        }
        $faqModel = $faqModelMapping[$tableName];
        if ($faqModel::findOrFail($prentId)) {
            $findModel = $faqModel::findOrFail($prentId);
            $faqTableName = $findModel->getFaqTable();
            if ($type == 'get_faqs') {
                $faqData = $findModel->getFaq()->get();
                return response()->json($faqData);
            } elseif ($type == 'add_faqs') {
                $insertData = [
                    'parent_id' => $prentId,
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'order' => $request->order ?? 0,
                ];
                DB::table($faqTableName)->insert($insertData);
                return response()->json(['success' => 'FAQ added successfully']);

            } elseif ($type == 'update_faqs') {
                $updateData = [
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'order' => $request->order ?? 0,
                ];
                DB::table($faqTableName)->where('id', $request->id)->update($updateData);
                return response()->json(['success' => 'FAQ updated successfully']);
            } elseif ($type == 'delete_faqs') {
                DB::table($faqTableName)->where('id', $request->id)->delete();
                return response()->json(['success' => 'FAQ deleted successfully']);
            } else {
                return response()->json(['error' => "Invalid type '$type'"], 404);
            }

        } else {
            return response()->json(['error' => "FAQ not found for table '$tableName'"], 404);
        }

    }
}
