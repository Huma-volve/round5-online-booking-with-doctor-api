<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
use App\Traits\API\apiTrait;

class SearchHistoryController extends Controller
{
    use apiTrait;


    public function searchHistory(){
        $search=SearchHistory::join("users","search_histories.user_id","=","users.id")
        ->select("users.*,search_histories.*");

        return $this->successResponse($search,"search history fteched successfully",200);
    }



     public function storeSearchHistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'search' => 'string|nullable',
        ]);

        $search = strtolower($request->search); 
        $parts = explode(" in ", $search); 

        if (count($parts) < 2) {
            return $this->errorResponse(null, 'Invalid search format. Use "term in location".', 422);
        }

        $record = new SearchHistory();
        $record->user_id = $request->user_id;
        $record->search_term = trim($parts[0]);
        $record->location = trim($parts[1]);
        $record->save();

        return $this->successResponse([], "Search added successfully", 201);
    }




}
