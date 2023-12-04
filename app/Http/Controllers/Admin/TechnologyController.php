<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Support\Str;
use App\Functions\Helper;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = Technology::where('name', $request->name)->first();
        if($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Il nome della tecnologia esiste già');
        }else {
            $new_technology = new Technology();
            $new_technology->name = $request->name;
            $new_technology->slug = Helper::generateSlug($request->name, Technology::class);
            $new_technology->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Il nome della tecnologia è stato salvato con successo');

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
    public function update(Request $request, Technology $technology)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:20',
        ], [
            'name.required' => 'Il nome della tecnologia è obbligatorio',
            'name.min' => 'Il nome della tecnologia deve essere maggiore di 2 caratteri',
            'name.max' => 'Il nome della tecnologia deve essere minore di 20 caratteri'
        ]);

        $exist = Technology::where('name', $request->name)->first();
        if($exist) {
            return redirect()->route('admin.technologies.index')->with('error', 'Il nome della tecnologia esiste già');
        }

        $val_data['slug'] = Helper::generateSlug($request->name, Technology::class);

        $technology->update($val_data);

        return redirect()->route('admin.technologies.index')->with('success', 'Il nome della tecnologia è stato modificato con successo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'La tecnologia è stata eliminata con successo');
    }
}
