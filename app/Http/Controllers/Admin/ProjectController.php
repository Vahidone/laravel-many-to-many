<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Functions\Helper;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use Illuminate\Database\Query\Builder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // per la parte search
        if(isset($_GET['toSearch'])) {

            $projects = Project::where('title', 'LIKE', '%'. $_GET['toSearch']. '%')->paginate(10);
        }else {
            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }


       $direction = 'desc';
       $toSearch = '';

        return view('admin.projects.index', compact('projects', 'direction', 'toSearch'));

    }

    public function orderBy($direction, $column) {

        $direction = $direction == 'desc'? 'asc' : 'desc';

        $projects = Project::orderBy($column, $direction)->paginate(10);

        $toSearch = '';

        return view('admin.projects.index', compact('projects', 'direction', 'toSearch'));

    }

    public function search(Request $request) {

        $toSearch = $request->toSearch;

        $projects = Project::where('title', 'LIKE', '%'. $toSearch. '%')->paginate(10);

        $direction = 'desc';

        return view('admin.projects.index', compact('projects', 'toSearch', 'direction'));
    }



    public function noTechnologies() {

        $projects = Project::whereNotIn('id', function (Builder $query) {
            $query->select('project_id')->from('project_technology');
        })->paginate(10);

        $direction = 'desc';

        return view('admin.projects.index', compact('projects', 'direction'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Inserimento nuovo progetto';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create-edit', compact('title','method', 'route', 'project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
        $form_data['release_date'] = date('Y-m-d');


        if(array_key_exists('image', $form_data)) {


            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();

            $form_data['image'] = Storage::put('uploads', $form_data['image']);

        }

        $new_project = Project::create($form_data);

        // se trova la chiave technology vuol dire che sono stati selezionati delle technology
        if(array_key_exists('technologies', $form_data)) {
            $new_project->technologies()->attach($form_data['technologies']);
        }



        return redirect()->route('admin.projects.show', $new_project);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)

    {
        $title = 'Modifica progetto';
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create-edit', compact('title','method', 'route', 'project', 'types', 'technologies' ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        if($form_data['title']!= $project->title){
            $form_data['slug'] = Helper::generateSlug($form_data['title'], project::class);
        }else{
            $form_data['slug'] = $project->slug;
        }

        if(array_key_exists('image', $form_data)){

            if($project->image){

                Storage::disk('public')->delete($project->image);
            }


            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();

            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        $form_data['date'] = date('Y-m-d');

        $project->update($form_data);

        if(array_key_exists('technologies', $form_data)) {
            $project->technologies()->sync($form_data['technologies']);

        }else {
            $project->technologies()->detach();
        }
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)

    {

        // non elimino le relazioni tra i projects e le technologie perché nella mihgration ho messo cascadeOnDelete() altrimenti avrei dovuto fare_ $project->technologies()->detach();


        // se il progetto contiene un'immagine vuol dire che la devo eliminare
        if($project->image){
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', "Il $project->title è stato eliminato correttamente");
    }
}
