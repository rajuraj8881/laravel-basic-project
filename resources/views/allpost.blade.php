@extends('include.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show All Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Post</a></li>
                        <li class="breadcrumb-item active">All Post</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @foreach($posts as $post)
        <section class="content">
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-6 shadow-block">
                            <div class="row">
                                <div class="col-md-10 my-4">
                                    <img src="assets/dist/img/prod-1.jpg" class="rounded-circle" alt="Cinque Terre" width="50" height="50" >
                                    <strong class="ms-0 text-info">Raju Mondal</strong>
                                </div>
                                <div class="col-md-2 my-3">
                                    <a class="ajax-action-links mx-2" href='edit-post/{{ $post->id }}'>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="ajax-action-links mx-2" href='delete-post/{{ $post->id }}'>
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-6">
                            <h3 class="my-3">{{ $post->title }}</h3>
                            <p>{{ $post->description }}</p>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <img src="{{ $post->photo }}" class="post-image">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    @endforeach()
@stop

