@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Save Film') }} <span class = "float-right"><a href ="{{url('/films')}}" class = "btn btn-primary"><i class = "fa fa-plus"></i> Go Back</a></span></div>
                <div class="card-body">
					<div class = "show-message col-md-12 text-center"></div>
                    <form method="POST" id = "save-film" action="{{ url('api/film/save') }}" enctype = "multipart/form-data">
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
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-8">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required></textarea>

								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="release_date" class="col-md-4 col-form-label text-md-right">{{ __('Release Date') }}</label>

                            <div class="col-md-8">
                                <input id="release_date" type="text" class="form-control{{ $errors->has('release_date') ? ' is-invalid' : '' }}" name="release_date" required>

								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                            <div class="col-md-8">
                                <input id="rating" type="number" min="0" max="5" step="0.1" class="form-control" name="rating" required>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="ticket_price" class="col-md-4 col-form-label text-md-right">{{ __('Ticket Price') }}</label>

                            <div class="col-md-8">
                                <input id="ticket_price" type="number" step="0.01" min="0" class="form-control" name="ticket_price" required>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-8">
                                <select id="country" class="form-control" name="country" required>
									<option value = "">Choose Country</option>
									<option value = "United State">United State</option>
									<option value = "India">India</option>
									<option value = "France">France</option>
									<option value = "Germany">Germany</option>
									<option value = "Italy">Italy</option>
									<option value = "Europe">Europe</option>
									<option value = "Australia">Australia</option>
									<option value = "China">China</option>
									<option value = "Japan">Japan</option>
									<option value = "Canada">Canada</option>
								</select>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Genre') }}</label>

                            <div class="col-md-8">
								<label>
                                <input type="checkbox" class="genre" name="genre[]" value = "Action"> Action
								</label><br/>
								<label>
                                <input type="checkbox" class=" genre" name="genre[]" value = "Adventure"> Adventure
								</label><br/>
								<label>
                                <input type="checkbox" class=" genre" name="genre[]" value = "Horror"> Horror
								</label><br/>
								<label>
                                <input type="checkbox" class=" genre" name="genre[]"  value = "Fantasy"> Fantasy
								</label><br/>
								<label>
                                <input type="checkbox" class=" genre" name="genre[]" value = "Thriller"> Thriller
								</label><br/>
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-8">
                                <input id="photo" type="file" class="form-control {{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo" required style = "border: none;">
								<span class="invalid-feedback" role="alert">
									<strong></strong>
								</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" id = "save-film-btn">
                                    <i class="process-submit hidden fa fa-spinner fa-spin"></i> {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
 $(document).ready(function() {
	 $('input#release_date').datepicker({
		 format: 'yyyy-mm-dd'
	 });
	 
	 $('#save-film-btn').click(function() {
		 $('.show-message').removeClass('alert alert-success');
		 $('.show-message').html('');
		 $('.process-submit').removeClass('hidden');
		 var form = new FormData($('#save-film')[0]), formData = $('#save-film').serialize(), formElem = $('#save-film');
		 formElem.find(':input').attr('disabled', true);
		 $.ajax({
			 url: API_URL + '/film/save',
			 type: 'POST',
			 data: form,
			 processData: false,
			 contentType: false,
			 success: function(res) {
				 $('.show-message').addClass('alert alert-success');
				 $('.show-message').html(res.msg);
				 $('html,body').animate({scrollTop: $('.show-message').offset().top}, 500);
				 $('.process-submit').addClass('hidden');
				 formElem.find(':input').removeAttr('disabled');
				 formElem.find(':input').closest('div').find('span.invalid-feedback').find('strong').html('');
				 formElem.find(':input').removeClass('is-invalid');
				 setTimeout(function() {
					 window.location.href="{{url('/films')}}";
				 }, 2000);
			 },
			 error: function(err) {
				 formElem.find(':input').removeAttr('disabled');
				 $('.process-submit').addClass('hidden');
				 var err = $.parseJSON(err.responseText);
				 formElem.find(':input').removeClass('is-invalid');
				 if(err.status_code == 422) {
					$.each(err.msg, function(i, v) {
						console.log(formElem.find(':input#'+i));
						setTimeout(function() {
							formElem.find(':input#'+i).addClass('is-invalid');
							formElem.find(':input#'+i).closest('div').find('span.invalid-feedback').find('strong').html('');
							if(formElem.find(':input#'+i).length == 0) {
								formElem.find(':input.'+i).closest('div').find('span.invalid-feedback').hide();
								formElem.find(':input.'+i).removeClass('is-invalid');
								formElem.find(':input.'+i).addClass('is-invalid');
								formElem.find(':input.'+i).closest('div').find('span.invalid-feedback').show();
								formElem.find(':input.'+i).closest('div').find('span.invalid-feedback').find('strong').html(v);
							}
							formElem.find(':input#'+i).closest('div').find('span.invalid-feedback').find('strong').html(v);
						},70);
					});	
				 }
			 }
			 
		 });
	 });
 });
</script>
@endsection