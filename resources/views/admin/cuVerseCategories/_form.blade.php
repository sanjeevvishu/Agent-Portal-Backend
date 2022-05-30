<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('title', null,['class' =>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
            {!! Form::text('description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
   
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
