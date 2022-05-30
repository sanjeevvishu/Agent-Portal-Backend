@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('CuVerse Categories') }} <a class="btn btn-sm btn-secondary"
                        href="{{ route('admin.cuVerseCategories.create') }}">Add New</a>
                </div>

                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="50%">Title</th>
                                <th width="10%">Status</th>
                                <th width="10%">Created At</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cuVerseCategories as $row)
                                <tr>
                                    <td scope="row">{{ $row->id }}</td>
                                    <td>
                                        <div>{{ ucwords($row->title) }}</div>
                                        <div>{{ $row->slug }}</div>
                                    </td>
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
                                    
                                        <a href="{{ route('admin.cuVerseCategories.edit',$row->id) }}" title="Edit">Edit</a>

                                        | <form method="post" class="delete_form"
                                            action="{{ route('admin.cuVerseCategories.destroy',$row->id) }}"
                                            style="display: inline">@method('DELETE') @csrf <button
                                                class="btn btn-link m-0 p-0" type="submit"
                                                title="Remove"
                                                onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                        </form>
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
                    {{$cuVerseCategories->links()}}
                    </div>

                </div>
                <!-- card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
