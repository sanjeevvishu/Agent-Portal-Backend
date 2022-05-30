{{--
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('vagon_app_id', 'Vagon app id', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('vagon_app_id', null,['class' =>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('region', 'Region', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::text('region', null,['class' =>'form-control']) !!}
        </div>
    </div>
</div>
--}}
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('vagon_stream_url', 'Vagon stream URL', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('vagon_stream_url', null,['class' =>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('note', 'Note', ['class' => 'form-label']) !!}
            {!! Form::textarea('note', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('server', 'Server Type', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('server', ['1'=>'Live Server', '0' => 'Staging Server'], null,['class'
            =>'form-select'])
            !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('status', ['1'=>'publish', '0' => 'unpublish'], null,['class'
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
