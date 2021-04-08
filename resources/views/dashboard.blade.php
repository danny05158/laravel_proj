@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-header">Submit Website</div>
                 <div class="card-body">
                  <form method="POST" action="/dashboard">
                    <input id="website" type="website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('email') }}"
                    required autofocus>
                      <button type="submit" class="btn btn-primary">
                      Submit
                      </button>
                 </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
