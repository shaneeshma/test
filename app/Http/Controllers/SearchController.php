<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Department;
use \App\Models\Designation;
use \App\Models\User;

class SearchController extends Controller
{
    public function searchData(Request $req)
    {
        $searchResult = User::join('departments', 'departments.id', 'users.fk_department')
            ->join('designations', 'designations.id', 'users.fk_designation');
        if ($req->search_data) {
            $searchResult = $searchResult->where('users.name', 'like', "%" . $req->search_data . "%")
                ->orWhere('departments.name', 'like', "%" . $req->search_data . "%")
                ->orWhere('designations.name', 'like', "%" . $req->search_data . "%");
        }
        $searchResult = $searchResult->select('users.name as user_name', 'departments.name as department_name', 'designations.name as designation_name')
            ->orderBy('users.name', 'ASC')
            ->orderBy('designations.name')
            ->orderBy('departments.name')
            ->get();
        return response()->json(array('message' => 'Success', 'data' => $searchResult));
    }
}
