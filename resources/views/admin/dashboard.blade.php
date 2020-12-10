@extends('layouts.admin.app')

@section('title', 'Dashboard')

@push('css')
    
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Post</div>
                    <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Favorite Post</div>
                    <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_posts->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Pending Post</div>
                    <div class="number count-to" data-from="0" data-to="{{$pendingPost}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">visibility</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Views</div>
                    <div class="number count-to" data-from="0" data-to="{{$viewCount}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">apps</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Category</div>
                    <div class="number count-to" data-from="0" data-to="{{$categoryCount->count()}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-blue hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">labels</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Category</div>
                    <div class="number count-to" data-from="0" data-to="{{$tagCount->count()}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-deep-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Total Author</div>
                    <div class="number count-to" data-from="0" data-to="{{$authorCount}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-deep-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">fiber_new</i>
                </div>
                <div class="content">
                    <div class="text text-uppercase">Today Author</div>
                    <div class="number count-to" data-from="0" data-to="{{$newAuthorToday}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h4>Most Popular Post</h4>
                </div>
                <div class="body">
                    <div class="table-reponsive">
                        <table class="table table-hove dashboard-task-infos">
                            <thead>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Views</th>
                                <th>Favorite</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($popularPost as $key => $post)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($post->title, '30')}}</td>
                                    <td>{{ $post->user->name}}</td>
                                    <td>{{ $post->view_count}}</td>
                                    <td>{{ $post->favorite_to_users_count}}</td>
                                    <td>{{ $post->comments_count}}</td>
                                    <td>
                                        @if ($post->status == true)
                                        <span class="bg-green">Published</span>
                                        @else
                                            <span class="bg-red">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('post.details',$post->slug)}}" class="btn btn-sm btn-primary waves-effect" target="_blank">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-12">
            <div class="card">
                <div class="header text-uppercase">
                    <h2>Top 10 Active Author</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeAuthor as $key=>$author)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->posts_count }}</td>
                                    <td>{{ $author->comments_count }}</td>
                                    <td>{{ $author->favorite_posts_count }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{asset('/')}}assets/admin/plugins/jquery-countto/jquery.countTo.js"></script>
    <script src="{{asset('/')}}assets/admin/js/pages/index.js"></script>
@endpush