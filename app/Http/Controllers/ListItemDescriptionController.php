<?php

namespace App\Http\Controllers;

use App\Listitem;
use App\Description;
use Illuminate\Http\Request;

class ListItemDescriptionController extends Controller
{
    public function index($listitemId){
        return Description::OfListitem($listitemId)->paginate();
    }

    public function show($listitemId,$descriptionId){
        $description = Description::OfListitem($listitemId)->findOrFail($descriptionId);

        return $description;
    }

    public function store(Request $request, $listitemId){

        // validate our input description
        $this->validate($request, [  'description' => 'required' , 'author' => 'required', 'title' => 'required']);

        $listitem = Listitem::findOrFail($listitemId);
        $listitem->descriptions()->save(new Description([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author')
        ]));

        return $listitem->descriptions;
    }

    public function update(Request $request, $listitemId, $descriptionId){

        $description = Description::OfListitem($listitemId)->findOrFail($descriptionId);

        if($request->input('author') == $description['author']){
            $description->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'author' => $request->input('author')
            ]);
            return $description;
        }else{
            // Unprocessable entity
            return response()->json(['name' => 'Failure! You are not the author of this description'], 422);

        }
    }

    public function destroy($listitemId,$descriptionId)
    {
        $description = Description::OfListitem($listitemId)->findOrFail($descriptionId);

        $description->delete();

        return $description;
    }
}
