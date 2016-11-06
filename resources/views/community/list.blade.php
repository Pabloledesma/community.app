<ul class="list-group">
	@if(count($links))
		@foreach ($links as $link)
			<li class="list-group-item">
				<a 
					href="/community/{{ $link->channel->slug }}" 
					class="label label-default" 
					style="background: {{ $link->channel->color }}"
				>
					{{ $link->channel->title }}
				</a>

				<a href="{{ $link->link }}" target="_blank">
					{{ $link->title }}
				</a>

				<small>
					Contributed By <a href="#">{{ $link->creator->name }}</a> 
					{{ $link->updated_at->diffForHumans() }}
				</small>
			</li>
		@endforeach
	@else
		<li class="Links__link">No contributions yet</li>
	@endif
</ul>

{{ $links->links() }}