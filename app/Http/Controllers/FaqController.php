<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;

class FaqController extends Controller {
    use apiTrait;
    public function index() {
        $faqs = Faq::orderBy('order')->get();
        return $this->successResponse($faqs, 'FAQs retrieved successfully', 200);
    }

    public function show($id) {
        $faq = Faq::find($id);
        if (!$faq) {
            return $this->errorResponse('FAQ not found', 404);
        }
        return $this->successResponse($faq, 'FAQ retrieved successfully', 200);
    }
    public function store(Request $request) {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);
        $faq = Faq::create($data);
        return $this->successResponse($faq, 'FAQ created successfully', 201);
    }
    public function update($id, Request $request) {
        $faq = Faq::find($id);
        if (!$faq) {
            return $this->errorResponse('FAQ not found', 404);
        }
        $data = $request->validate([
            'question' => 'sometimes|string|max:255',
            'answer' => 'sometimes|string',
            'order' => 'sometimes|integer',
            'status' => 'sometimes|in:active,inactive',
        ]);
        $faq->update($data);
        return $this->successResponse($faq, 'FAQ updated successfully', 200);
    }
    public function destroy($id) {
        $faq = Faq::find($id);
        if (!$faq) {
            return $this->errorResponse('FAQ not found', 404);
        }
        $faq->delete();
        return $this->successResponse([], 'FAQ deleted successfully', 204);
    }
}
