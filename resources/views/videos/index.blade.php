@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class='videos'>

        @foreach ($videos as $video)

        @include('partials.video')

        @endforeach

    </div>
</div>

<div class='row paginator'>
    {{ $videos->links() }}
</div>

@endsection
