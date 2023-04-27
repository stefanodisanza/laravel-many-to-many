<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::whereNull('deleted_at')->get();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        $technologies = Technology::all();
        return view('projects.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titolo' => 'required|max:255',
            'cliente' => 'required|max:255',
            'descrizione' => 'required|max:255',
        ]);

        $project = new Project();
        $project->titolo = $request->titolo;
        $project->cliente = $request->cliente;
        $project->descrizione = $request->descrizione;
        $project->slug = Str::slug($request->titolo);
        $project->save();

        $project->technologies()->attach($request->input('technologies'));

        return redirect()->route('projects.index')->with('status', 'Project created successfully!');
    }

    public function show($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        return view('projects.show', compact('project'));
    }

    public function edit($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $technologies = Technology::all();
        return view('projects.edit', compact('project', 'technologies'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'titolo' => 'required|max:255',
            'descrizione' => 'required',
        ]);
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $project->titolo = $request->titolo;
        $project->descrizione = $request->descrizione;
        $project->slug = Str::slug($request->titolo);
        $project->save();

        $project->technologies()->sync($request->input('technologies'));

        return redirect()->route('projects.show', $project->slug)->with('status', 'Project updated successfully!');
    }


    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();
        return redirect()->route('projects.index')->with('status', 'Project cancellato con successo!');
    }

    public function restore($slug)
    {
        $project = Project::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $project->restore();
        return redirect()->route('projects.index')->with('status', 'Project restored successfully!');
    }
}
