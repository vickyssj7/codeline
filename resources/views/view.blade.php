@extends('layouts.app')

@section('content')
<style>
	a {
		color: #000 !important;
	}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
					{{ __( 'Films' ) }}
					<span class = "float-right"><a href ="{{url('/film/create')}}" class = "btn btn-primary"><i class = "fa fa-plus"></i> Add Film</a></span>
				</div>

                <div class="card-body">
					@if(count($film_data))
					<div class = "row form-group">
						@foreach($film_data as $film)
						<div class="film-box form-group col-md-4 text-center">
							<a href = "{{url('/films/'.$film->slug)}}"><img src="{{url($film->photo)}}" width="200" class="img img-thumbnail" /><br/>
							<strong>{{$film->name}}</strong><br/>
							<strong>Price:</strong> ${{$film->ticket_price}}<br/>
							<strong>Rating:</strong> {{$film->rating}}<br/>
							<strong>Country:</strong> {{$film->country}}<br/>
							<strong>Genre:</strong> {{$film->genre}}<br/></a>
						</div>
						@endforeach
					</div>
					@else
						<div class = "alert alert-warning">
							<p>No Movies Found</p>
						</div>
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
