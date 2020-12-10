@extends('layouts.website.app')

@section('title', 'All Post')

@push('css')
    <link href="{{asset('/')}}assets/website/css/post/styles.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/website/css/post/responsive.css" rel="stylesheet">
    <style>
        /* .slider {
            height: 400px;
            width: 100%;
            background-size: cover;
            margin: 0;
            background-image: url();
        } */
		.favorite_post {
			color: blue;
		}
	</style>
@endpush

@section('content')
    <div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>ALL POST</b></h1>
	</div>
    <section class="blog-area section">
		<div class="container">
			<div class="row">
				@foreach ($posts as $post)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image">
								<img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="{{$post->title}}">
							</div>

							<a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
								<img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="{{$post->user->name}}">
							</a>

							<div class="blog-info">

								<h4 class="title">
									<a href="{{ route('post.details', $post->slug) }}"><b>{{$post->title}}</b></a>
								</h4>

								<ul class="post-footer">
									<li>
									@guest
										<a href="javascript:void(0)" onclick="toastr.info('To add favorite list.Need to login first.','info',{
											closeButton: true,
											progressBar: true
										})"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>
									@else
										<a href="javascript:void(0)" onclick="document.getElementById('add-favorite-{{$post->id}}').submit();"
										class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite_post':''}}"	
										>
											<i class="ion-heart"></i>{{$post->favorite_to_users->count()}}
										</a>
										<form action="{{route('post.favorite',$post->id)}}" method="post" id="add-favorite-{{$post->id}}">
										@csrf
										</form>
									@endguest
									</li>
									<li>
										<a href="#">
											<i class="ion-chatbubble"></i>
											{{$post->comments->count()}}
										</a>
									</li>
									<li>
										<a href="#">
											<i class="ion-eye"></i>
											{{$post->view_count}}
										</a>
									</li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
				@endforeach

			</div><!-- row -->

			{{ $posts->links() }}

		</div><!-- container -->
	</section>
@endsection

@push('js')
    
@endpush