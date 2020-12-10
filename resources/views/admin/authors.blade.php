@extends('layouts.admin.app')

@section('title' , 'All Authors')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('/')}}assets/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <script src="{{asset('/')}}assets/admin/plugins/sweetalert/sweetalert.css"></script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Author
                        <span class="badge bg-blue">{{ $authors->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite Posts</th>
                                    <th>Created Data</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite Posts</th>
                                    <th>Created Data</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($authors as $author)
                                <tr>
                                    <td>{{$author->id}}</td>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->posts->count() }}</td>
                                    <td>{{ $author->comments->count() }}</td>
                                    <td>{{ $author->favorite_posts->count() }}</td>
                                    <td>{{ $author->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a href="{{route('admin.category.edit',$author->id)}}" class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" type="button" onclick="deleteAuthor({{ $author->id }})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form id="delete-form-{{$author->id}}" action="{{route('admin.author.destroy', $author->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
        function deleteAuthor(id){
             
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Delete this author!",
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