<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FilmController extends Controller
{
    
	public function format_slug($title)
	{
		$title = trim(strtolower($title));
		$title = preg_replace('#[^a-z0-9\\-/]#i', '-', $title);
		return trim(preg_replace('/-+/', '-', $title), '-/');
	}
	
	public function create(Request $request, $id = NULL)
    {
		if($request->isMethod('POST')) {
			$messages = [
				'release_date.required' => 'Release Date must be a valid date.',
				'genre.required' => 'You must choose at least one genre.',
				'photo.image' => 'Photo must be an image.',
				'rating.required' => 'Rating must be a valid number.',
				'ticket_price.required' => 'Ticket Price must be a valid number.',
			];
			$validator = Validator::make($request->all(), [
				'name' => 'required',
				'description' => 'required',
				'rating' => 'required|numeric|min:1|max:5',
				'release_date' => 'required|date',
				'ticket_price' => 'required|numeric',
				'country' => 'required',
				'genre' => 'required',
				'photo' => 'required|image',
			], $messages);

			if ($validator->fails()) {
				throw new HttpResponseException(response()->json(['status_code' => 422, 'msg' => $validator->errors()], 422));
			}
			
			$form['name'] = $request->input('name');
			$isDuplicateFilmName = \DB::table('films')->where('slug','=', $this->format_slug($form['name']))->count();
			if($isDuplicateFilmName) {
				throw new HttpResponseException(response()->json(['status_code' => 422, 'msg' => ['name' => ['Duplicate Film Name not Allowed']]], 422));
			}
			$form['slug'] = $this->format_slug($form['name']);
			$form['rating'] = $request->input('rating');
			$form['description'] = $request->input('description');
			$form['release_date'] = $request->input('release_date');
			$form['ticket_price'] = $request->input('ticket_price');
			$form['country'] = $request->input('country');
			$genre = $request->input('genre');
			foreach($genre as $genData) {
				$genreData[] = $genData;
			}
			$form['genre'] = implode(', ', $genreData);
			
			if($request->hasFile('photo')) {
				try {
					$filmPhoto = $request->file('photo');
					if(!is_dir(base_path('uploads'))) {
						mkdir(base_path('uploads'),0777,true);
					}
					$getFileName = $filmPhoto->getClientOriginalName();
					$getFileName = time().'_'.$getFileName;
					if($filmPhoto->move(base_path('uploads'), $getFileName)) {
						$form['photo'] = 'uploads/'.$getFileName;
					}
				} catch(\Exception $e) {
					throw new HttpResponseException(response()->json(['status_code' => 422, 'msg' => ['photo' => [$e->getMessage()]]], 422));
				}
			}
			
			$film = \DB::table('films')->insertGetId($form);
			if($film) {
				return response()->json(['status_code' => 200, 'msg' => 'Film saved']);
			}
		}
        return view('create', [
			'id' => $id
		]);
    }
	
    public function view()
    {
        $film_data = \DB::table('films')->orderBy('id','DESC')->get();
        return view('view', [
			'film_data' => $film_data
		]);
    }
	
	public function singleFilm($slug) {
		if($slug) {
			$film_data = \DB::table('films')->where('slug',$slug)->get();
			if(count($film_data)) {
				$getComments = \DB::table('comments')->where('film_id','=',$film_data[0]->id)->get();
				if(count($getComments)) {
					foreach($getComments as &$commentData) {
						$getUser = \DB::table('users')->where('id',$commentData->user_id)->get();
						$commentData->user = '';
						if(count($getUser)) {
							$commentData->user = $getUser[0]->name;
						}
					}
				}
				return view('singlefilm', [
					'film_data' => $film_data,
					'film_comments' => $getComments
				]);
			}
			return redirect('/');
		}
		return redirect('/');
	}
	
	public function comments(Request $request, $slug) {
		if($slug && Auth::check()) {
			$film_data = \DB::table('films')->where('slug',$slug)->get();
			if(count($film_data)) {
				if($request->isMethod('post')) {
					\DB::table('comments')->insert([
						'film_id' => $film_data[0]->id,
						'user_id' => Auth::user()->id,
						'name' => $request->input('name'),
						'comment' => $request->input('comment')
					]);
					return redirect('/films/'.$slug);
				}
			}
		}
		return redirect('/films/'.$slug);
	}
}
