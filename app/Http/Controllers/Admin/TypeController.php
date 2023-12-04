<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function typeProject()
    {
        $types = Type::all();
        return view('admin.projects.type-projects', compact('types'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = Type::where('title', $request->title)->first();
        if($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Il nome della type esiste già');
        }else {
            $new_type = new Type();
            $new_type->title = $request->title;
            $new_type->slug = Helper::generateSlug($request->title, Type::class);
            $new_type->save();

            return redirect()->route('admin.types.index')->with('success', 'Il nome della type è stato salvato con successo');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $val_data = $request->validate([
            'title' => 'required|min:2|max:20',
        ], [
            'title.required' => 'Il nome della type è obbligatorio',
            'title.min' => 'Il nome della type deve essere maggiore di 2 caratteri',
            'title.max' => 'Il nome della type deve essere minore di 20 caratteri'
        ]);

        $exist = Type::where('title', $request->title)->first();
        if($exist) {
            return redirect()->route('admin.types.index')->with('error', 'Il nome della type esiste già');
        }

        $val_data['slug'] = Helper::generateSlug($request->title, Type::class);

        $type->update($val_data);

        return redirect()->route('admin.types.index')->with('success', 'Il nome della type è stato modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'La type è stata eliminata con successo');
    }
}
