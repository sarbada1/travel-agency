<?php

namespace App\Http\Controllers\Backend\Testimonial;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Testimonial\TestimonialCreateRequest;
use App\Repositories\Testimonial\TestimonialInterface;
use Illuminate\Http\Request;

class TestimonialController extends BackendController
{
    protected $aInterface;

    public function __construct(TestimonialInterface $aInterface)
    {
        parent::__construct();
        $this->aInterface = $aInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'testimonials_list');
        $this->data('testimonial', $this->aInterface->all());
        return view($this->pagePath . 'testimonial.index', $this->data);
    }

    public function show(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'testimonials_show');
        $this->data('testimonial', $this->aInterface->get($id));
        return view($this->pagePath . 'testimonial.show', $this->data);
    }

    public function create(Request $request)
    {
        $this->checkAuthorization($request->user(), 'testimonials_create');
        return view($this->pagePath . 'testimonial.create', $this->data);
    }

    public function store(TestimonialCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'testimonials_create');
        $this->aInterface->insert($request->all());
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Created Successfully');
    }


    public function edit(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'testimonials_edit');
        $this->data('testimonial', $this->aInterface->get($id));
        return view($this->pagePath . 'testimonial.update', $this->data);
    }


    public function update(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'testimonials_edit');
        $this->aInterface->update($request->all(), $id);
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Updated Successfully');
    }


    public function destroy(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'testimonials_delete');
        $this->aInterface->delete($id);
        return redirect()->route('manage-testimonial.index')->with('success', 'Testimonial Deleted Successfully');
    }
}
