<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('title', 'Title', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('title', null,['class' =>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
            {!! Form::text('slug', null,['class' =>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('small_description', 'Small description', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::text('small_description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('medium_description', 'Medium description', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>

            {!! Form::textarea('medium_description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('long_description', 'Long description', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::textarea('long_description', null,['class' =>'form-control tinymce','rows' =>2]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('meta_title', 'Meta Title', ['class' => 'form-label']) !!}
            {!! Form::text('meta_title', null,['class' =>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('meta_description', 'Meta description', ['class' => 'form-label']) !!}
            {!! Form::textarea('meta_description', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
        <div class="mb-3">
            {!! Form::label('meta_keywords', 'Meta Keywords', ['class' => 'form-label']) !!}
            {!! Form::textarea('meta_keywords', null,['class' =>'form-control','rows' =>2]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('min_price', 'Min price', ['class' => 'form-label']) !!}
            {!! Form::text('min_price', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('max_price', 'Max price', ['class' => 'form-label']) !!}
            {!! Form::text('max_price', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('min_built_up_area', 'Min built up area', ['class' => 'form-label']) !!}
            {!! Form::text('min_built_up_area', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('max_built_up_area', 'Max built up area', ['class' => 'form-label']) !!}
            {!! Form::text('max_built_up_area', null,['class' =>'form-control']) !!}
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('property_stage', 'Property stage', ['class' => 'form-label']) !!}
            {!! Form::number('property_stage', null,['min' => 0 ,'max' => 100,'class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('property_area', 'Property area', ['class' => 'form-label']) !!}
            {!! Form::text('property_area', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('property_type', 'Property type', ['class' => 'form-label']) !!}
            {!! Form::text('property_type', null,['class' =>'form-control']) !!}
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
            {!! Form::label('currency_symbol', 'Currency symbol', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::text('currency_symbol', null,['class' =>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! Form::label('address', 'Address', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('address', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('city', 'City', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('city', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('state', 'State', ['class' => 'form-label']) !!}
            {!! Form::text('state', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('country', 'Country', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            {!! Form::text('country', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('zip_code', 'Zip code', ['class' => 'form-label']) !!}
            {!! Form::text('zip_code', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('latitude', 'Latitude', ['class' => 'form-label']) !!}
            {!! Form::text('latitude', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('longitude', 'Longitude', ['class' => 'form-label']) !!}
            {!! Form::text('longitude', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('google_map_embed', 'Google map embed', ['class' => 'form-label']) !!}
            {!! Form::text('google_map_embed', null,['class' =>'form-control']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('google_map_shortlink', 'Google map shortlink', ['class' => 'form-label']) !!}
            {!! Form::text('google_map_shortlink', null,['class' =>'form-control']) !!}
        </div>
    </div>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! Form::label('portal_2d_url', 'Portal 2d url', ['class' => 'form-label']) !!}
            {!! Form::text('portal_2d_url', null,['class' =>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_2d_enabled', 'Is 2d enabled', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('is_2d_enabled', ['0' => 'NO', '1'=>'YES'], null,['class'
            =>'form-select']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_3d_enabled', 'Is 3d enabled', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('is_3d_enabled', ['0' => 'NO', '1'=>'YES'], null,['class'
            =>'form-select']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_single_building', 'Is single building', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>

            {!! Form::select('is_single_building', ['0' => 'NO', '1'=>'YES'], null,['class'
            =>'form-select']) !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('is_featured', 'Is featured', ['class' => 'form-label']) !!} <span
                class="text-danger">*</span>
            {!! Form::select('is_featured', ['0' => 'NO', '1'=>'YES'], null,['class'
            =>'form-select']) !!}
        </div>
    </div>
</div>
@if(!empty($project))
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                {!! Form::label('logo_image', 'Logo image', ['class' => 'form-label']) !!} <span
                    class="text-danger">*</span>
                <div>{!! Form::file('logo_image')
                    !!}</div>
            </div>
        </div>
        <div class="col-md-3">
            @if($project->logo_image)
                <div class="mb-3">
                    {!! Form::label('logo_image2', 'Preview', ['class' => 'form-label']) !!}
                    <div>
                        <img src="{{ asset($project->media_s3_base_path.$project->logo_image) }}" width="100"
                            class="img-fluid" />
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                {!! Form::label('featured_image', 'Featured image', ['class' => 'form-label']) !!} <span
                    class="text-danger">*</span>
                <div>{!! Form::file('featured_image')
                    !!}</div>
            </div>
        </div>
        <div class="col-md-3">
            @if($project->featured_image)
                <div class="mb-3">
                    {!! Form::label('featured_image2', 'Preview', ['class' => 'form-label']) !!}
                    <div>
                        <img src="{{ asset($project->media_s3_base_path.$project->featured_image) }}" width="100"
                            class="img-fluid" />
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-3">
        <div class="mb-3">
            {!! Form::label('amenities', 'Amenities', ['class' => 'form-label']) !!} <span class="text-danger">*</span>
            @if(empty($project))
                {!! Form::select('amenities[]', $amenities, null,['class'
                =>'form-select multiSelect','multiple'=>true])
                !!}
            @else
                {!! Form::select('amenities[]', $amenities, $project->amenities,['class'
                =>'form-select multiSelect','multiple'=>true])
                !!}
            @endif

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



@push('css')
    <link href="{{ asset('vendor/lou-multi-select/css/multi-select.css') }}" rel="stylesheet">

@endpush
@push('js')

    <script src="{{ asset('vendor/lou-multi-select/js/jquery.multi-select.js') }}"></script>
    <script>
        $(document).ready(function ($) {
            $('.multiSelect').multiSelect();
        });

    </script>
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
