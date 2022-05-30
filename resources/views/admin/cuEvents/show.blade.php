@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('View Project') }} - {{ $project->title }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.index') }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

