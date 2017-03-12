				<div class="col-sm-3 sidebar sidebar2">
					<div class="row m0 sidebar_row_inner">
						<!--Popular Videos-->                        
						<div class="row m0 widget">
							<h5 class="widget_title">Yogscast Channels</h5>
							<div class="row m0 inner">
								@foreach (App\Channel::orderBy('slug', 'asc')->get() as $channel)
								<div class='sidebar-channel col-sm-12'>
									<a href='/{{ $channel->slug }}'>
									{{ $channel->title }}
									</a>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>