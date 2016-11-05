@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>Community</h1>
		<div class="row">
			<div class="col-md-8">
				<ul class="Links">
					@foreach ($links as $link)
						<li class="Links__link">
							<a href="{{ $link->link }}" target="_blank">
								{{ $link->title }}
							</a>

							<small>
								Contributed By <a href="#">{{ $link->creator->name }}</a> 
								{{ $link->updated_at->diffForHumans() }}
							</small>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-4">
				<h3>Contribute a Link</h3>
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="POST" action="/community">
							{{csrf_field()}}
							<div class="form-group">
								<label for="title">Title:</label>
								<input type="text" name="title" id="title" class="form-control" placeholder="What is the title of your article?">
							</div>
							<div class="form-group">
								<label for="link">Link:</label>
								<input type="text" name="link" id="link" class="form-control" placeholder="What is the url?">
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary">Contribute Link</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>

@stop