<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listitem;

class ListItemController extends Controller
{
    public function index(){
        return Listitem::paginate();
    }

    public function show($id){
        $listitem = Listitem::findOrFail($id);

        return $listitem;
    }

    public function store(Request $request){

        $listitem = Listitem::create([
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'overview' => $request->input('overview')
        ]);

        return $listitem;
    }
}
