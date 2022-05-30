@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('CuVerse upload files for') }} <strong>{{ $project->title}}</strong> <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.cuVerses.index') }}">Back</a></div>

                <div class="card-body">

                    <!-- <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 ">
                            <div class="float-end">
                                <a class="btn btn-sm btn-secondary"  href="{{ route('admin.cuVerses.show',$project->id) }}">Upload</a>
                                <a class="btn btn-sm btn-danger "  href="{{ route('admin.cuVerses.show',$project->id) }}">Refresh</a>
                            </div>

                        </div>
                    </div>      -->
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                             <cuverse-upload-component></cuverse-upload-component>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('topjs')
<script>
const projectId = "{{ $project->id }}";
const cuVerseUploadUploadUrl   = "{{ route('admin.cuVerses.store',$project->id)}}"; 
const cuVerseUploadListUrl   = "{{ route('admin.cuVerses.list',$project->id)}}"; 
const cuVerseUploadDeleteUrl   = "{{ route('admin.cuVerses.delete',$project->id)}}"; 
const cuVerseCategories = @json($cuVerseCategories);
const cuVerseLanguages = @json($cuVerseLanguages);
const cuVerseVisibilities = @json($cuVerseVisibilities);
</script>
@endpush
