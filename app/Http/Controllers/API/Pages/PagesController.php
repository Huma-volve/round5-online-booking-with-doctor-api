<?php

namespace App\Http\Controllers\API\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller {
    public function termsAndConditions() {
        $markdown = file_get_contents(base_path('resources/pages/terms_and_condetions.md'));
        return response()->json([
            'content' => $markdown
        ]);
    }
    public function privacyPolicy() {
        $markdown = file_get_contents(base_path('resources/pages/privacy_policy.md'));
        return response()->json([
            'content' => $markdown
        ]);
    }
}
