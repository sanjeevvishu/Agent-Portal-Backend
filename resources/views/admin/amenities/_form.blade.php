<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('title', null,['class' =>'form-control']) !!}
        </div>
        
    </div>
</div>

    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                {!! Form::label('icon_file', 'Icon file image', ['class' => 'form-label']) !!} <span
                    class="text-danger">*</span>
                <div>{!! Form::file('icon_file') !!}</div>
            </div>
        </div>
        <div class="col-md-3">
            @if(!empty($amenity))
            @if($amenity->s3_icon_path)
                <div class="mb-3">
                    {!! Form::label('icon_file2', 'Preview', ['class' => 'form-label']) !!}
                    <div>
                        <img src="{{ asset($amenity->media_s3_base_path.$amenity->s3_icon_path) }}" width="100"
                            class="img-fluid" />
                    </div>
                </div>
            @endif
            @endif
        </div>
    </div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::select('status', ['1'=>'publish', '0' => 'unpublish'], null,['class'
            =>'form-select'])
            !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::submit('submit',['class' =>'btn btn-lg btn-secondary']) !!}
        </div>
    </div>
</div>
