@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Units') }} - {{$project->title}} <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.projects.units.create',$project->id) }}">Add New</a>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Cubedots ID</th>
                                <th >Apartment ID</th>
                                <th >Status</th>
                                <th >Checks</th>
                                <th >Block</th>
                                <th >Floor</th>
                                <th >Bedroom</th>
                                <th >Built Up A.</th>
                                <th >Price Int.</th>
                                <th >Price Loc.</th>
                                <th >Published</th>
                                <th >Created At</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($units as $row)
                                <tr>
                                    <td scope="row">{{ $row->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.units.edit',$row->id) }}">
                                            {{ $row->cubedots_id }}
                                        </a>
                                    </td>
                                    <td>{{ $row->apartment_id }}</td>
                                    <td>
                                        
                                        @if(strtolower($row->status) == 'available')
                                        <span class="badge badge-pill bg-success">available</span>
                                        @elseif(strtolower($row->status) == 'reserved')
                                        <span class="badge badge-pill bg-danger">reserved</span>
                                        @elseif(strtolower($row->status) == 'on-hold')
                                        <span class="badge badge-pill bg-warning">on-hold</span>
                                        @elseif(strtolower($row->status) == 'sold')                        
                                        <span class="badge badge-pill bg-primary">sold</span>
                                        @endif

                                    </td>
                                   
                                    <td>{{ $row->checks }}</td>
                                    <td>{{ $row->block }}</td>
                                    <td>{{ $row->floor }}</td>
                                    <td>{{ $row->bedroom }}</td>
                                    <td>{{ $row->built_up_area }}</td>
                                   
                                    
                                    <td>{{ number_format($row->price_international,2) }}</td>
                                    <td>{{ number_format($row->price_local,2) }}</td>
                                    <td> 
                                    @if($row->is_published)
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
                                        <!-- <a href="{{ route('admin.units.show',$row->id) }}" title="Add units">View</a> -->

                                         <a href="{{ route('admin.units.edit',$row->id) }}" title="Edit">Edit</a>

                                        | <form method="post" class="delete_form"
                                            action="{{ route('admin.units.destroy',$row->id) }}"
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
                    {{$units->links()}}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
