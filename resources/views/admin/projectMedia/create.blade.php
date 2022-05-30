@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Media') }} - {{ $project->title }} <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.media.index',$project->id) }}">Back</a>
                </div>

                <div class="card-body">

                    @include('components.validation_alert')

                    {!! Form::open(['url' => route('admin.projects.media.store', $project->id) ]) !!}
                    {!! Form::close() !!}

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-banner-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-banner" type="button" role="tab" aria-controls="pills-banner"
                                aria-selected="true">Banner</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-gallery-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery"
                                aria-selected="false">Gallery</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-floorplan-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-floorplan" type="button" role="tab" aria-controls="pills-floorplan"
                                aria-selected="false">Floorplans</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-views-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-views" type="button" role="tab" aria-controls="pills-views"
                                aria-selected="false">Views</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-video-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video"
                                aria-selected="false">Video</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-banner" role="tabpanel"
                            aria-labelledby="pills-banner-tab">
                            
                            <banner-component></banner-component>
                            
                        </div>
                        <div class="tab-pane fade" id="pills-gallery" role="tabpanel"
                            aria-labelledby="pills-gallery-tab">
                            
                            <gallery-component></gallery-component>
                        </div>
                        <div class="tab-pane fade" id="pills-floorplan" role="tabpanel"
                            aria-labelledby="pills-floorplan-tab">
                            
                            <floorplan-component></floorplan-component>
                        </div>
                        <div class="tab-pane fade" id="pills-views" role="tabpanel"
                            aria-labelledby="pills-views-tab">
                            
                            <views-component></views-component>
                        </div>
                        <!-- <div class="tab-pane fade" id="pills-video" role="tabpanel"
                            aria-labelledby="pills-video-tab">
                            video
                        </div> -->
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('topjs')
<script>
const mediatGalleryUploadUrl   = "{{ route('admin.projects.media.store',$project->id)}}"; 
const mediatGalleryListUrl   = "{{ route('admin.projects.media.list',$project->id)}}"; 
const mediatGalleryDeleteUrl   = "{{ route('admin.projects.media.delete',$project->id)}}"; 
</script>
@endpush
