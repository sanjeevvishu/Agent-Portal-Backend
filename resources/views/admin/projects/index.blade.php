@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Projects') }} <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.projects.create') }}">Add New</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Project Name</th>
                                    <!-- <th width="10%">Developer</th> -->
                                    <th width="8%">Is Featured</th>
                                    <th width="05%">Is 2D</th>
                                    <th width="05%">Is 3D</th>
                                    <th width="10%">City</th>
                                    <th width="10%">Country</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Created At</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $row)
                                    <tr>
                                        <td scope="row">{{ $row->id }}</td>
                                        <td>
                                            <!-- <a href="{{ route('admin.projects.edit',$row->id) }}"> -->
                                            <div>{{ ucwords($row->title) }}</div>
                                            <div>{{ $row->slug }}</div>
                                            <!-- </a> -->
                                        </td>
                                        <td>
                                            @if($row->is_featured)
                                                <span class="badge badge-pill bg-success">YES</span>
                                            @else
                                                <span class="badge badge-pill bg-warning">NO</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->is_2d_enabled)
                                                <span class="badge badge-pill bg-success">YES</span>
                                            @else
                                                <span class="badge badge-pill bg-warning">NO</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->is_3d_enabled)
                                                <span class="badge badge-pill bg-success">YES</span>
                                            @else
                                                <span class="badge badge-pill bg-warning">NO</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->city }}</td>

                                        <td>{{ $row->country }}</td>
                                        <td>
                                            @if($row->status)
                                                <span class="badge badge-pill bg-success">Publish</span>
                                            @else
                                                <span class="badge badge-pill bg-danger">UnPublish</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $row->created_at->format('Y-m-d') }}</small><br>
                                            <small>{{ $row->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.vagonapps.index',$row->id) }}"
                                                title="Vagon Apps">Vagon Apps</a>
                                            | <a href="{{ route('admin.projects.media.index',$row->id) }}"
                                                title="Add media">Media</a>

                                            | <a href="{{ route('admin.projects.show',$row->id) }}"
                                                title="Add units">View</a>
                                            {{-- | <a href="{{ route('admin.projects.show',$row->id) }}"
                                            title="Add units">View</a> --}}

                                            | <a href="{{ route('admin.projects.edit',$row->id) }}"
                                                title="Edit">Edit</a>

                                            | <form method="post" class="delete_form"
                                                action="{{ route('admin.projects.destroy',$row->id) }}"
                                                style="display: inline">@method('DELETE') @csrf <button
                                                    class="btn btn-link m-0 p-0" type="submit" title="Remove"
                                                    onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" style="text-align: center">No record to show</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="float-end">
                        {{ $projects->links() }}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
