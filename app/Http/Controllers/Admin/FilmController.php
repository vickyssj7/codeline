<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class FilmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		if(Auth::check() && Auth::user()->user_type != 'admin') {
			return redirect('/');
		}
    }
	
	public function create(Request $request, $id = NULL)
    {
		if($id) {
			//we are in edit mode
		} else {
			
		}
        return view('admin.create', [
			'id' => $id
		]);
    }
	
	public function deleteFilm()
    {
        return view('admin.view');
    }
	
    public function view()
    {
        $film_data = [];
        return view('admin.view', [
			'film_data' => $film_data
		]);
    }
}
