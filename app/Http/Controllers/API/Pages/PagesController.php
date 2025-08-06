<?php

namespace App\Http\Controllers\API\Pages;

use App\Models\Page;
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\Pages\PagesResourse;

class PagesController extends Controller {
    use apiTrait;
    public function index() {
        $pages = Page::all();
        return $this->successResponse(PagesResourse::collection($pages), 'All pages');
    }

    public function show(string $type) {
        $page = Page::where('type', $type)->first();
        if (!$page) {
            return $this->errorResponse('Page not found', 404);
        }
        return $this->successResponse(PagesResourse::collection($page));
    }

    public function store(Request $request) {

        $data = $request->validate([
            'type' => 'required|string|max:255|unique:pages,type',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $page = Page::create($data);
        return $this->successResponse(new PagesResourse($page), 'Page created successfully', 201);
    }

    public function update($id, Request $request) {
        $page = Page::find($id);
        if (!$page) {
            return $this->errorResponse('Page not found', 404);
        }
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $page->update($data);
        return $this->successResponse(new PagesResourse($page), 'Page updated successfully');
    }

    public function destroy($id) {
        $page = Page::find($id);
        if (!$page) {
            return $this->errorResponse('Page not found', 404);
        }
        $page->delete();
        return $this->successResponse([], 'Page deleted successfully');
    }
}
