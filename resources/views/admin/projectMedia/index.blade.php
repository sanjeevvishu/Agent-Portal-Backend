@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Media') }} - {{$project->title}} <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.projects.media.create',$project->id) }}">Add New</a>
                        <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.index') }}">Back</a>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Asset Type</th>
                                <th >Category</th>
                                <th >Image</th>
                                <th >Name</th>
                                <th >Created At</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projectMedias as $row)
                                <tr>
                                    <td scope="row">{{ $row->id }}</td>
                                    
                                    <td>{{ $row->asset_type }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td><img src="{{ asset($row->media_s3_base_path.$row->local_path) }}" width="100" class="img-fluid" /> </td>
                                    <td>{{ $row->file_name }}</td>
                                    
                                    <td>
                                        <div><small>{{ $row->created_at->format('Y-m-d') }}</small></div>
                                       
                                    </td>
                                    <td>
                                        <!-- <a href="{{ route('admin.media.show',$row->id) }}" title="Add units">View</a> -->

                                         <!--  <a href="{{ route('admin.media.edit',$row->id) }}" title="Edit">Edit</a> -->

                                        <form method="post" class="delete_form"
                                            action="{{ route('admin.media.destroy',$row->id) }}"
                                            style="display: inline">@method('DELETE') @csrf <button
                                                class="btn btn-link m-0 p-0" type="submit"
                                                title="Remove"
                                                onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr >
                                    <td colspan="7" style="text-align: center">No record to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                  
                    <div class="float-end">
                    {{$projectMedias->links()}}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
