<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_active', true)
            ->orderBy('status', 'asc') // 'completed' comes before 'ongoing' alphabetically, wait. Ongoing should probably be separate or filtered.
            // Let's get both separately to show in tabs as requested.
            ->get();

        $completedProjects = $projects->where('status', 'completed');
        $ongoingProjects = $projects->where('status', 'ongoing');

        $title = 'Projelerimiz';
        $description = 'Tamamlanan ve devam eden referans projelerimizden örnekler.';

        return view('projects.index', compact('completedProjects', 'ongoingProjects', 'title', 'description'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $title = $project->title;
        $description = $project->description;

        return view('projects.show', compact('project', 'title', 'description'));
    }
}
