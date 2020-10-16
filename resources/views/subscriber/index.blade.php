@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end py-2">
        
    </div>
    <div class="card">
        <div class="card-header">
            Subscriber List
        </div>
        @if ($subscribers->count() > 0)
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->diffforhumans() }}</td>
                            <td>
                                <button class="btn btn-danger" onclick="handleDelete({{ $subscriber->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="removeSubscriberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" id="removeSubscriberForm" method="POST">
                        @csrf 
                        @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Subscriber Remove</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">Are you sure to remove this Subscriber?</div>
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
        @else 
            <h2 class="bg-dark text-white text-center p-3 m-3">No Subscriber Found</h2>
        @endif
    </div>
@endsection

@section('scripts')
   <script>
       function handleDelete(id){
           var form = document.getElementById('removeSubscriberForm')
           form.action = '/subscriber/' + id
           $('#removeSubscriberModal').modal('show')
       }
   </script>
@endsection