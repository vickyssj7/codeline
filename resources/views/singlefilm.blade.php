@extends('layouts.app')

@section('content')
<style>
	a {
		color: #000 !important;
	}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="form-group col-md-12">
            <div class="card">
                <div class="card-header">
					{{ __( ' Film: '  . $film_data[0]->name ) }}
					<span class = "float-right"><a href ="{{url('/films')}}" class = "btn btn-primary"><i class = "fa fa-arrow-left"></i> Go Back</a></span>
				</div>

                <div class="card-body">
					@if(count($film_data))
					<div class = "row form-group">
						@foreach($film_data as $film)
						<div class="film-box form-group col-md-12 ">
							<h2>{{$film->name}}</h2>
							<p><img src="{{url($film->photo)}}" width="700" /></p>
							<p><strong>Price:</strong> ${{$film->ticket_price}} |
							<strong>Rating:</strong> {{$film->rating}} |
							<strong>Country:</strong> {{$film->country}} |
							<strong>Genre:</strong> {{$film->genre}}</p>
							<p>{{$film->description}}</p>
						</div>
						@endforeach
					</div>
					@endif
                </div>
            </div>
        </div>
		<div class="form-group col-md-12">
            <div class="card">
                <div class="card-header">
					{{ __( 'Comments' ) }}
				</div>

                <div class="card-body">
					
					@if(Auth::check())
					<form method="POST" id = "save-comment" action="{{ url('/film/comments/'.$film_data[0]->slug) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                            <div class="col-md-8">
                                <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" value="{{ old('comment') }}" required></textarea>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
						 <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id = "save-film-btn">
                                   {{ __('Add Comment') }}
                                </button>
                            </div>
                        </div>
					</form>	
					@endif
					@if(count($film_comments))
						@foreach($film_comments as $commentData)
							<div class = "col-md-12 form-group" style = "padding: 10px;background: #e1e1e1;margin-top: 20px;">
								<h6><i class = "fa fa-user"></i> {{$commentData->user}} ({{$commentData->name}}):</h6>
								<p style = "margin-left: 20px;">{{$commentData->comment}}</p>
								<p style = "margin-left: 20px;"><i>Added At: {{date('F d, Y h:i a',strtotime($commentData->created_at))}}</i></p>
							</div>
						@endforeach
					@else
						<div class = "alert alert-warning">No Comments Found</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
