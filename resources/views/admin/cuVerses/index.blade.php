@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('CuVerse') }} 
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="60%">Project</th>
                               
                                <th width="10%">Created At</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $row)
                                <tr>
                                    <td scope="row">{{ $row->id }}</td>
                                    <td>
                                        <div>{{ ucwords($row->title) }}</div>
                                        
                                    </td>
                                   
                                    <td>
                                        <small>{{ $row->created_at->format('Y-m-d') }}</small>
                                       
                                    </td>
                                    <td>
                                    
                                        <a href="{{ route('admin.cuVerses.show',$row->id) }}" title="View">Upload</a>
                                       
                                    </td>
                                </tr>
                            @empty
                                <tr >
                                    <td colspan="8" style="text-align: center">No record to show</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                  
                    <div class="float-end">
                    {{$projects->links()}}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
