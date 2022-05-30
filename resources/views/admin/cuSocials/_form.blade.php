<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('title', null,['class' =>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('category', 'Category', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('category', $categories, null,['class'
            =>'form-select','placeholder' => 'select']) !!} 
        </div>

        <div class="mb-3">
            {!! Form::label('youtube_url', 'Youtube URL', ['class' => 'form-label']) !!}
            {!! Form::text('youtube_url', null,['class' =>'form-control',]) !!}
        </div>

        <div class="mb-3">
            {!! Form::label('small_description', 'Small description', ['class' => 'form-label']) !!} 
            {!! Form::text('small_description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('medium_description', 'Medium description', ['class' => 'form-label']) !!} 

            {!! Form::textarea('medium_description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('long_description', 'Long description', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span> 
            {!! Form::textarea('long_description', null,['class' =>'form-control tinymce','rows' =>2]) !!}
        </div>
       
    </div>
</div>
{{--
<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_featured', 'Is featured', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('is_featured', ['0' => 'NO', '1'=>'YES'], null,['class'
            =>'form-select']) !!}
        </div>
    </div>
</div>
--}}

    <div class="row">
        
        <div class="col-md-3">
            <div class="mb-3">
                {!! Form::label('featured_image', 'Featured image', ['class' => 'form-label']) !!} <span
                    class="text-danger">*</span>
                <div>{!! Form::file('featured_image')
                    !!}</div>
            </div>
        </div>
        <div class="col-md-3">
            @if(!empty($cuSocial))
            @if($cuSocial->featured_image)
                <div class="mb-3">
                    {!! Form::label('featured_image2', 'Preview', ['class' => 'form-label']) !!}
                    <div>
                        <img src="{{ asset($cuSocial->media_s3_base_path.$cuSocial->featured_image) }}" width="100"
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


@push('js')

    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            convert_urls: false,
            forced_root_block: false,
            statusbar: false,
            extended_valid_elements: 'html|head|meta|style[type|link|body',
            allow_conditional_comments: true,
            protect: [
                /\<\/?(if|endif)\>/g, // Protect <if> & </endif>
                /\<xsl\:[^>]+\>/g, // Protect <xsl:...>
                /<\?php.*?\?>/g // Protect php code
            ],
            selector: 'textarea.tinymce',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            //imagetools_cors_hosts: ['picsum.photos'],
            menubar: false,
            //menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | insertfile image media | code preview fullscreen',
            // toolbar_sticky: true,
            //   importcss_append: true,
            //   height: 600,
        });

    </script>
@endpush
