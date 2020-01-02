@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">

            @csrf

            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">

                    <h1>Edit profile</h1>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label">Title</label>

                        <input id="title"
                               type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title"
                               value="{{ old('title') ?? $user->profile->title }}"
                               required
                               autocomplete="title" autofocus>

                        @error('title')
                        <strong>{{ $errors->first('title') }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label">Description</label>

                        <input id="description"
                               type="text"
                               class="form-control @error('description') is-invalid @enderror"
                               name="description"
                               value="{{ old('description') ?? $user->profile->description }}"
                               required
                               autocomplete="description" autofocus>

                        @error('description')
                        <strong>{{ $errors->first('description') }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label">URL</label>

                        <input id="url"
                               type="text"
                               class="form-control @error('url') is-invalid @enderror"
                               name="url"
                               value="{{ old('url') ?? $user->profile->url }}"
                               required
                               autocomplete="url" autofocus>

                        @error('url')
                        <strong>{{ $errors->first('url') }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">

                        <label for="image" class="col-md-4 col-form-label">Profile image</label>
                        <input type="file" class="form-control-file" id="image" name="image">

                        @error('image')
                        <strong>{{ $errors->first('image') }}</strong>
                        @enderror

                    </div>

                    <div class="row pt-4">
                        <button class="btn btn-primary">Save Profile</button>
                    </div>

                </div>
            </div>

        </form>

    </div>
@endsection
