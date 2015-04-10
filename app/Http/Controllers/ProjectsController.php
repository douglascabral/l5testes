<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Carbon\Carbon;

class ProjectsController extends Controller {

	
	private $rules = ['name' => 'required|min:2', 'slug' => 'required|min:2'];
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$expiresAt = Carbon::now()->addSeconds(60);
		$value = Cache::remember('rand_markdown', $expiresAt, function()
		{
			return rand(0, 1000);
		});
		
		
		//Cache::put('key', rand(0, 1000), $expiresAt);
		
		return app('Markdown')->render('**'. $value .'**');
		$title = "Título 1";
		$projects = Project::all();
		
		return view('projects.index', compact('projects', 'title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, $this->rules);
		
		$input = Input::all();
		Project::create($input);
		
		return Redirect::route('projects.index')->with('message', 'Project created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Project $project)
	{
		return view('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	//public function edit($id)
	public function edit(Project $project)
	{
		return view('projects.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Project $project)
	{
		$this->validate($request, $this->rules);
		
		$input = array_except(Input::all(), '_method');
		$project->update($input);
		
		return Redirect::route('projects.show', $project->slug)->with('message', 'Project updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Project $project)
	{
		$project->delete();
		
		return Redirect::route('projects.index')->with('message', 'Project deleted');
	}

}
