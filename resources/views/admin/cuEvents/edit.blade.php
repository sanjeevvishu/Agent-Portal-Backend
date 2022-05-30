@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit CuEvent') }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.cuEvents.index') }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::model($cuEvent,['url' => route('admin.cuEvents.update',$cuEvent->id),'method'=>'PUT', 'files' => true ]) !!}

                    @include('admin.cuEvents._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

