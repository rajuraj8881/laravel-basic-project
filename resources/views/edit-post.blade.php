@extends('include.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Post</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <form action="{{ route('Update.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $post->id }}">
            @if(Session::has('post_update'))
                    {{ Session::get('post_update') }}

            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Post</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="PostTitle">Title</label>
                                <input type="text" name="PostTitle" id="PostTitle" class="form-control" value="{{ $post->title }}">
                            </div>
                            <div class="form-group">
                                <label for="postDescription">Description</label>
                                <textarea name="postDescription" id="postDescription" class="form-control" rows="4" >{{ $post->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="postPhoto">Photo</label><br>
                                <input type="file" name="postPhoto" id="postPhoto">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('allPost') }}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Update Post" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
@stop
