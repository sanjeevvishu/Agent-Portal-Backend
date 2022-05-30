@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Unit') }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.units.index',$unit->project_id) }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::model($unit,['url' => route('admin.units.update',$unit->id),'method'=>'PUT' ]) !!}

                    @include('admin.units._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

