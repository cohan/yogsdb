@extends('ydb.master')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="/video/{{ $video->id }}">

	{{ csrf_field() }}

	<input type="hidden" name="_method" value="PUT">
	<div class="col-sm-9 post_page_uploads">
		<div class="row">
			<div class="author_details post_details row m0">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->youtube_id }}"></iframe>
				</div>
				<div class="row post_title_n_view">
					<h2 class="col-sm-12 post_title">{{ $video->title }}</h2>
				</div>
				<div class="media bio_section" style="height:250px">
					<div class="edit-metadata media-right col-sm-12">
						<h5>Starring</h5>
						<select id='starpicker' class="show-menu-arrow show-tick" title="Choose one of the following..." name='starring[]' multiple="multiple" >
							@foreach (App\Star::orderBy('title', 'asc')->get() as $star)
							@if (in_array($star->id, $video->stars->pluck('id')->toArray()))
							<option selected value="{{ $star->id }}">{{ $star->title }}</option>	
							@else
							<option value="{{ $star->id }}">{{ $star->title }}</option>	
							@endif
							@endforeach
						</select>

						@hasanyrole(['admin', 'moderator'])
						<div class="btn-group pull-right" role="group" aria-label="...">
							<br />
							<input type='submit' type="button" class="btn btn-primary" value='Save' />
							<a href='javascript:history.go(-1);' type="button" class="btn btn-danger">Cancel</a>
						</div>
						@endrole

					</div>

				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#starpicker").chosen();
</script>
@endsection