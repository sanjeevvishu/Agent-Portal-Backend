@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Amenity') }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.amenities.index') }}">Back</a></div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::open(['url' => route('admin.amenities.store'),'files' => true ]) !!}

                    @include('admin.amenities._form')

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
