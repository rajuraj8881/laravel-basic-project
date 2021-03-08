@extends('include.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Post</a></li>
                        <li class="breadcrumb-item active">Add Post</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
    <form action="{{ route('save.post') }}" method="post" enctype="multipart/form-data">
    @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Post</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="PostTitle">Title</label>
                            <input type="text" name="PostTitle" id="PostTitle" class="form-control" placeholder="Title here.." value="{{ old('PostTitle') }}" >
                        </div>
                        <div class="form-group">
                            <label for="postDescription">Description</label>
                            <textarea name="postDescription" id="postDescription" class="form-control" rows="4" placeholder="Write here...">{{ old('postDescription') }}</textarea>
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
                <a href="{{ route('addPost') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Published" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    </section>
@stop
