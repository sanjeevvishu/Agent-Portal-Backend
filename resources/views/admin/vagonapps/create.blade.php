@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Vagon app') }} - {{$project->title}}  <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.vagonapps.index',$project->id) }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::open(['url' => route('admin.projects.vagonapps.store', $project->id) ]) !!}

                    @include('admin.vagonapps._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
