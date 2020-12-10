@extends('layouts.website.app')

@section('title')
    {{ $keyword }}
@endsection

@push('css')
    <link href="{{asset('/')}}assets/website/css/single-post/styles.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/website/css/single-post/responsive.css" rel="stylesheet">
    <style>
        .slider {
            height: 400px;
            width: 100%;
            background-size: cover;
            margin: 0;
            background-image: url({{asset('assets/website/images/category-1.jpg')}});
        }
		.favorite_post {
			color: blue;
		}
	</style>
@endpush

@section('content')
    <div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $posts->count() }} Results for {{ $keyword }}</b></h1>
	</div>
    <section class="recomended-area section">
		<div class="container">
			<div class="row">
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image">
                                    <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="{{$post->title}}">
                                </div>
                                <a class="avatar" href="{{ route('author.profile',$post->user->username) }}">
                                    <img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}" alt="{{$post->title}}">
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
                                        <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-lg-4 col-md-6 -->
                    @endforeach
                @else
                    <div class="col-12">
					<div class="card h-100">
						<div class="single-post post-style-1">
							<div class="blog-info">
								<h4 class="title">
									<strong>Sorry no post found</strong>
								</h4>
							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
                @endif
			</div><!-- row -->

		</div><!-- container -->
	</section>
@endsection

@push('js')
    
@endpush