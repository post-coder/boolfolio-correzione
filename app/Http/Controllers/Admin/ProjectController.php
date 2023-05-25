<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        // dd($formData);

        $this->validation($formData);

        $newProject = new Project();

        $newProject->fill($formData);
        $newProject->slug = Str::slug($newProject->title, '-');

        $newProject->save();

        $newProject->technologies()->attach($formData['technologies']);

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types =  Type::all();
        $technologies =  Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->all();

        // dd($formData);

        $this->validation($formData);

        $project->slug = Str::slug($formData['title'],'-');

        $project->update($formData);

        if(array_key_exists('technologies', $formData)) {
            $project->technologies()->sync($formData['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }


    //validazione
    private function validation($formData) {
        $validator = Validator::make($formData, [
            'title' => 'required|max:200',
            'repo' => 'required|max:255',
            'description' => 'required',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',

        ], [
            'title.required' => 'Il titolo deve essere compilato', 
            'title.max' => 'Il titolo può avere massimo :max caratteri', 
            'repo.required' => 'Il link della repo deve essere compilato', 
            'repo.max' => 'Il link della repo può avere massimo :max caratteri', 
            'description.required' => 'La descrizione deve essere inserita', 
            'type_id.exists' => 'La tipologia deve essere esistente nel nostro sito',
            'technologies.exists' => 'La tecnologia deve essere esistente nel nostro sito'
        ])->validate();

        return $validator;
    }
}
