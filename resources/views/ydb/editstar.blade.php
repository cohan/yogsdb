@extends('ydb.master')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="/star/{{ $star->slug }}">

	{{ csrf_field() }}

	<input type="hidden" name="_method" value="PUT">
	<div class="col-sm-9 post_page_uploads">
		<div class="row">
			<div class="author_details post_details row m0">
				<div class="row post_title_n_view">
					<h2 class="col-sm-12 post_title">{{ $star->title }}</h2>
				</div>

				<div class="media bio_section" style="min-height:420px;">
					<div class="edit-metadata media-right col-sm-12">
						<h5>Auto Star Patterns</h5>

						<div class='autostar-patterns col-sm-12'>
							<p>Remember to surround your auto tags with a delimiter, these are regular expressions we're playing with here</p>
							<table style='width:100%; margin:10px;'>
								<thead style='font-weight:bold;'>
									<td>Pattern</td>
									<td>Weight</td>
									<td>Title Modifier</td>
									<td>Delete</td>
								</thead>
								<tbody id='patterns-body'>
									@foreach ($star->patterns as $pattern)
									<tr>
										<td class='col-sm-8'><input style='width:100%;' type='text' name='pattern[{{ $pattern->id }}][pattern]' value='{{ $pattern->pattern }}'/></td>
										<div class='col-sm-4'>
											<td><input type='text' name='pattern[{{ $pattern->id }}][weight]' value='{{ $pattern->weight }}'/></td>
											<td><input type='text' name='pattern[{{ $pattern->id }}][title_modifier]' value='{{ $pattern->title_modifier }}'/></td>
											<td><input style='float:right;' type="checkbox" name='pattern[{{ $pattern->id }}][delete]'></td>
										</div>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class='col-sm-1 col-sm-offset-11' style='margin-top:10px;'>
							<button class='btn btn-success' onclick='addRow();return false;'>Add</button>
						</div>

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
	<script type="text/javascript">
		var newID = '0';

		function addRow() {
			var newpattern = `
			<tr>
			<td class='col-sm-8'><input style='width:99.9%;' type='text' name='newpattern[` + newID + `][pattern]' value=''/></td>
			<td><input type='text' name='newpattern[` + newID + `][weight]' value=''/></td>
			<td><input type='text' name='newpattern[` + newID + `][title_modifier]' value=''/></td>
			</tr>
			`;
			$('#patterns-body').append(newpattern);

			newID++;
		}
	</script>
</form>
@endsection