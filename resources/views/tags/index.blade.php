@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end py-2">
        <a href="{{ route('tags.create') }}" class="btn btn-success">Add Tags</a>
    </div>
    <div class="card">
        <div class="card-header">
            Tags
        </div>
        @if ($tags->count() > 0)
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key => $tag)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->posts->count() }}</td>
                            <td>
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info">Edit</a>
                                <button class="btn btn-danger" onclick="handleDelete({{ $tag->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="deleteTagModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" id="deleteTagForm" method="POST">
                        @csrf 
                        @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">Are you sure to delete this Tag?</div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">No, Go Back</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
        @endif
    </div>
@endsection

@section('scripts')
   <script>
       function handleDelete(id){
           var form = document.getElementById('deleteTagForm')
           form.action = '/tags/' + id
           $('#deleteTagModal').modal('show')
           console.log(form)
       }
   </script>
@endsection