@if(Auth::check())
<div class="col-md-4">
	<h3>Contribute a Link</h3>
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="/community">
				{{csrf_field()}}

				<div class="form-group">
					<label for="Channel">Channel</label>

					<select 
						name="channel_id" 
						class="form-control {{ $errors->has('channel_id') ? 'has-error' : '' }}"
					>
						<option selected disabled>Pick a Channel...</option>
						@foreach($channels as $channel)
							<option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
								{{ $channel->title }}
							</option>
						@endforeach
					</select>
					{!! $errors->first('channel_id', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					<label for="title">Title:</label>
					<input 
						type="text" 
						name="title" 
						id="title" 
						class="form-control" 
						placeholder="What is the title of your article?" 
						value="{{ old('title') }}"
						required>

					{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
				</div>
				<div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
					<label for="link">Link:</label>
					<input 
						type="text" 
						name="link" 
						id="link" 
						class="form-control" 
						placeholder="What is the url?" 
						value="{{ old('link') }}"
						required>
					{!! $errors->first('link', '<span class="help-block">:message</span>') !!}
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Contribute Link</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endif