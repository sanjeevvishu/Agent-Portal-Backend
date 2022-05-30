@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Vagon app') }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.vagonapps.index',$vagonapp->project_id) }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::model($vagonapp,['url' => route('admin.vagonapps.update',$vagonapp->id),'method'=>'PUT' ]) !!}

                    @include('admin.vagonapps._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

