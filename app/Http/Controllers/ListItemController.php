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

        $this->validate($request, [  'name' => 'required|unique:listitems|max:255' ]);
        $this->validate($request, [  'author' => 'required' ]);
        $this->validate($request, [  'overview' => 'required' ]);

        $listitem = Listitem::create([
            'name' => $request->input('name'),
            'author' => $request->input('author'),
            'overview' => $request->input('overview')
        ]);

        return $listitem;
    }

    public function update(Request $request, $id ){

        $listitem = Listitem::findOrFail($id);

        if($request->input('author') == $listitem['author']){
            // validate our input burger
            $this->validate($request, [  'name' => 'required|unique:listitems|max:255' ]);
            $this->validate($request, [  'overview' => 'required' ]);

            $listitem->update([
                'name' => $request->input('name'),
                'overview' => $request->input('overview'),
                'author' => $request->input('author')
            ]);
            return $listitem;
        }else{
            // Unprocessable entity
            return response()->json(['name' => 'Failure! You are not the author of this item'], 422);

        }
    }
}
