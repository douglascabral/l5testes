<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Fileentry;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TestesController extends Controller {


	public function index()
	{
		
	}

	
	public function local()
	{
		Storage::disk('local2')->put('teste.txt', 'adkfjdakljfdaklfdjkl01');
	}
	
	public function download() 
	{
		return response()->download( storage_path() . '/app/teste.txt')->deleteFileAfterSend(true);
	}
}
