<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\StudyGroup;
use App\Models\ReportLost;


class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }
    /**
     * Search for posts or users
     */
    public function search(Request $request)
    {
        $query = $request->input('search');

        $type = $request->input('type', 'students');

        // 1. Initialize empty collections for all variables
        // This prevents "Undefined variable" errors in your view
        $users = collect();
        $studyGroups = collect();
        $lostItems = collect();

        if ($type === 'students') {
            $users = User::where('name', 'LIKE', "%$query%")->get();
        } elseif ($type === 'groups') {
            $studyGroups = StudyGroup::where('group_name', 'LIKE', "%$query%")->get();
        } elseif ($type === 'items') {
            $lostItems = ReportLost::where('item_name', 'LIKE', "%$query%")->get();
        }

        return view('search', compact('users', 'lostItems', 'studyGroups', 'query', 'type'));
    }
}
