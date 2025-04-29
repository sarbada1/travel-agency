<?php

namespace App\Http\Controllers\Backend\Faq;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Models\Faq\Faq;
use Illuminate\Http\Request;

class FaqController extends BackendController
{
    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'faqs_list');
        return view($this->pagePath . 'faq.index', $this->data);
    }

    public function allFaqs(Request $request)
    {
        $this->checkAuthorization($request->user(), 'faqs_list');
        $faqs = Faq::all();
        return response()->json($faqs);
    }

    public function store(Request $request)
    {
        $this->checkAuthorization($request->user(), 'faqs_create');
        $data = $request->all();
        $faq = Faq::create($data);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'faqs_edit');
        $data = $request->all();
        $faq = Faq::find($id);
        $faq->update($data);
        return response()->json($faq);
    }


    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'faqs_delete');
        $faq = Faq::find($id);
        $faq->delete();
        return response()->json(['success' => true]);
    }
}
