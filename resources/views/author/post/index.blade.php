@extends('layouts.admin.app')

@section('title' , 'All Posts')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('/')}}assets/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <script src="{{asset('/')}}assets/admin/plugins/sweetalert/sweetalert.css"></script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            <a href="{{route('author.post.create')}}" class="btn btn-primary waves-effect">
                <i class="material-icons">add</i>
                Add New Post
            </a>
        </h2>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Posts
                        <span class="badge bg-blue">{{ $posts->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>
                                        <i class="material-icons">visibility</i>
                                    </th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created Data</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>
                                        <i class="material-icons">visibility</i>
                                    </th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created Data</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php($i = 1)
                                @foreach ($posts as $row)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ Str::limit($row->title, 10, '...') }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->view_count }}</td>
                                        <td>
                                            @if ($row->is_approved == true)
                                               <span class="badge bg-blue">Approved</span> 
                                            @else
                                                <span class="badge bg-pink">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == true)
                                               <span class="badge bg-blue">Published</span> 
                                            @else
                                                <span class="badge bg-pink">Pending</span>
                                            @endif    
                                        </td>
                                        <td>
                                            {{$row->created_at->toFormattedDateString()}}
                                        </td>
                                        <td>
                                            <a href="{{route('author.post.show',$row->id)}}" class="btn btn-primary waves-effect">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{route('author.post.edit',$row->id)}}" class="btn btn-info waves-effect">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $row->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{$row->id}}" action="{{route('author.post.destroy', $row->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <script src="{{asset('/')}}assets/admin/js/pages/tables/jquery-datatable.js"></script>

    <script src="{{asset('/')}}assets/admin/plugins/sweetalert/sweetalert.latest.min.js"></script>
    <script type="text/javascript">
        function deletePost(id){
             
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your data is safe :)',
                'error'
                )
            }
            })
        }
    </script>
@endpush