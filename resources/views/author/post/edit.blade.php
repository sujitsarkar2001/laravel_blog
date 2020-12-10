@extends('layouts.admin.app')

@section('title' , 'Create Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{asset('/')}}assets/admin/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{route('author.post.update', $post->id)}}" class="" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Tag
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title" value="{{$post->title}}">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label for="image">Feature Image</label>
                                    <input type="file" id="image" class="form-control-file" name="image">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <input type="checkbox" id="status" name="status" value="1" {{$post->status == true ? 'checked':''}}>
                                <label for="status">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Categories & Tags</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line {{$errors->has('categories') ? 'focus-error':''}}">
                                    <label class="form-label">Select Category</label>
                                    <select class="form-control show-tick" multiple name="categories[]">
                                    @foreach ($categories as $item)
                                        <option 
                                            @foreach ($post->categories as $part)
                                                {{$part->id == $item->id ? 'selected':''}}
                                            @endforeach
                                            value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{$errors->has('tags') ? 'focus-error':''}}">
                                    <label class="form-label">Select Tags</label>
                                    <select class="form-control show-tick" multiple name="tags[]">
                                    @foreach ($tags as $item)
                                        <option 
                                            @foreach ($post->tags as $part)
                                                {{$part->id == $item->id ? 'selected':''}}
                                            @endforeach
                                            value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>TINYMCE</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="body">
                                {{$post->title}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Vertical Layout | With Floating Label --> 
    </div>
@endsection

@push('js')
    <!-- TinyMCE -->
    <script src="{{asset('/')}}assets/admin/plugins/tinymce/tinymce.js"></script>
    <script type="text/javascript">
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = "{{asset('/')}}assets/admin/plugins/tinymce";
        });
    </script>
@endpush