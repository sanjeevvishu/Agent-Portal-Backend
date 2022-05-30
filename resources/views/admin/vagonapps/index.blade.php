@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Vagon apps') }} - {{$project->title}} <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.projects.vagonapps.create',$project->id) }}">Add New</a>  <a
                        class="btn btn-sm btn-danger float-end"
                        href="{{ route('admin.projects.index') }}">Back</a>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                {{-- <th width="10%">Vagon App ID</th>
                                <th width="10%">Region</th>--}}
                                <th width="20%">Stream URL</th>
                                <th width="20%">Note</th>
                                <th width="10%">Status</th>
                              
                                <th width="10%">Created At</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vagonApps as $row)
                                <tr>
                                    <td scope="row">{{ $row->id }}</td>
                                    
                                    {{--<td>{{ $row->vagon_app_id }}</td>
                                    <td>{{ $row->region }}</td>--}}
                                    <td>{{$row->vagon_stream_url}}</td>
                                    <td>{{ $row->note }}</td>
                                   
                                    <td> 
                                    @if($row->status)
                                        <span class="badge badge-pill bg-success">Published</span>
                                    @else
                                        <span class="badge badge-pill bg-danger">UnPublished</span>
                                    @endif                                           
                                    </td>
                                    <td>
                                        <div><small>{{ $row->created_at->format('Y-m-d') }}</small></div>
                                        <div><small>{{ $row->updated_at->format('Y-m-d') }}</small></div>
                                       
                                    </td>
                                    <td>
                                         <a href="{{ route('admin.vagonapps.edit',$row->id) }}" title="Edit">Edit</a>

                                        | <form method="post" class="delete_form"
                                            action="{{ route('admin.vagonapps.destroy',$row->id) }}"
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
                    {{$vagonApps->links()}}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
