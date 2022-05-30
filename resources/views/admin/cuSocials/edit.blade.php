@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit CuSocial') }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.cuSocials.index') }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::model($cuSocial,['url' => route('admin.cuSocials.update',$cuSocial->id),'method'=>'PUT', 'files' => true ]) !!}

                    @include('admin.cuSocials._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

