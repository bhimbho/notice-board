@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Notice Manager') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form method="POST" action="{{ route('notice-manager.store') }}">
                                @csrf
        
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Title') }}</label>
        
                                    <div class="">
                                        <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class=" mb-3">
                                    <label for="password" class="">{{ __('Description') }}</label>
        
                                    <div class="">
                                        <textarea id="editor" class="form-control @error('description') is-invalid @enderror" name="description" required>
                                        </textarea>
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-info">Send for Approval</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                </tr>
                                @foreach ($notices as $notice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $notice->title }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
@endsection
