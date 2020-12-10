@extends('layouts.admin.app')

@section('title' , 'Create Post')

@push('css')
    
@endpush

@section('content')
    <div class="container-fluid">
            <h2>
                <a href="{{route('author.post.index')}}" class="btn btn-danger waves-effect"> BACK </a>
                @if ($post->is_approved == false)
                    <button class="btn btn-success pull-right waves-effect">
                        <i class="material-icons">done</i>
                        <span>Approve</span>
                    </button>
                @else
                    <button class="btn btn-success pull-right waves-effect" disabled>
                        <i class="material-icons">done</i>
                        <span>Approved</span>
                    </button>
                @endif
            </h2>
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$post->title}}
                            <small>Posted By 
                                <strong><a href="">{{$post->user->name}}</a></strong> on
                                {{$post->created_at->toFormattedDateString()}}
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                       {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2> Categories</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{$category->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2> Tags</h2>
                    </div>
                    <div class="body">
                        @foreach ($post->tags as $tag)
                            <span class="label bg-green">{{$tag->name}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2> Featured Image</h2>
                    </div>
                    <div class="body">
                    <img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="" class="img-responsive thumbnail">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label --> 
    </div>
@endsection

@push('js')
    
@endpush