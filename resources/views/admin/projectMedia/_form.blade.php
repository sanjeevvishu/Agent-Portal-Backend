<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('cubedots_id', 'Cubedots ID', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('cubedots_id', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('apartment_id', 'Apartment ID', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::text('apartment_id', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('price_international', 'Price International', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('price_international', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('price_local', 'Price Local', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('price_local', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::select('status', ['available' => 'available', 'reserved'=>'reserved', 'on-hold' => 'on-hold',
            'sold' => 'sold'], null, ['class'
            =>'form-select'])
            !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('built_up_area', 'Built up area', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::text('built_up_area', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('block', 'Block', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('block', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('floor', 'Floor', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('floor', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('bedroom', 'Bedroom', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('bedroom', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('checks', 'Checks', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('checks', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('unit_number', 'Unit number', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('unit_number', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('unit_id', 'Unit ID', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('unit_id', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('unit_type', 'Unit type', ['class' => 'form-label']) !!}
            {!! Form::text('unit_type', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('layout', 'Layout', ['class' => 'form-label']) !!}
            {!! Form::text('layout', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('direction', 'Direction', ['class' => 'form-label']) !!} 
            {!! Form::text('direction', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('balcony', 'Balcony', ['class' => 'form-label']) !!}
            {!! Form::text('balcony', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('terrace', 'Terrace', ['class' => 'form-label']) !!}
            {!! Form::text('terrace', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('private_parking', 'Private parking', ['class' => 'form-label']) !!}
            {!! Form::text('private_parking', null,['class' =>'form-control']) !!}
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('views', 'Views', ['class' => 'form-label']) !!}
            {!! Form::text('views', null,['class' =>'form-control']) !!}
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_published', 'Is published', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('is_published', ['1'=>'publish', '0' => 'unpublish'], null,['class'
            =>'form-select'])
            !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::submit('Submit',['class' =>'btn btn-lg btn-secondary']) !!}
        </div>
    </div>
</div>
