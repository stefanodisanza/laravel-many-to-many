<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withTrashed()->orderBy('created_at', 'desc')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->slug = Str::slug($request->title);
        $project->save();

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
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->slug = Str::slug($request->title);
        $project->save();

        return redirect()->route('projects.show', $project->slug)->with('status', 'Project updated successfully!');
    }

    public function destroy($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $project->delete();
        return redirect()->route('projects.index')->with('status', 'Project deleted successfully!');
    }

    public function restore($slug)
    {
        $project = Project::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $project->restore();
        return redirect()->route('projects.index')->with('status', 'Project restored successfully!');
    }
}
