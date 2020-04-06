@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Join the Organization') }}</div>

                <div class="card-body">
                    <form action="{{ route('join.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="organization_id" value="{{ $organization->id }}" />
                        Do you want to join organization <b>{{ $organization->name }}</b>?
                        <br />
                        <input type="submit" value=" Yes, Join " class="btn btn-primary" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
