@extends('layout.main')
@section('content')
<div class="container mt-5">
        <h4>Form View</h4>
        <div class="row justify-content-center">
            <div class="col col-md-4">
                <form action="/api/positions" id="addPosition"  method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Reports to</label>
                        <select class="form-select" name="reports_to" aria-label="Default select example">
                            <option value=""></option>
                            @foreach ($positions as $position)
                                <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Position</th>
                        <th scope="col">Reports To</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
@foreach($positions as $position)
                    <tr>
                        <td scope="col">{{$position->name}}</td>
                        <td scope="col">{{ $position->parent ? $position->parent->name : '' }}</td>
                        <td scpre="col">
                            <div class="row gap-4">
                                <div class="col-md-1">
                                    <a href="/positions/{{$position->id}}" class="btn btn-info">Edit</a>
                                </div>
                                <div class="col-md-1">
                                    <form id="deletePosition" action="/api/positions/{{$position->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
@endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Are you sure?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        You are about to delete the position. Do you want to proceed?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmBtn">Yes, Delete it</button>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('form#deletePosition').on("submit",function(e){
                e.preventDefault();
                const form=$(this);
                $('#confirmationModal').modal('show');
                $('#confirmBtn').on('click', function(){
                    $.ajax({
                    url: form.attr('action'),    // URL to send the request to
                    type: form.attr('method'),   // Form method (POST with @method('DELETE'))
                    data: form.serialize(),      // Serialize the form data
                    success: function(response) {
                        // Handle success response (e.g., show a success message)
                        // alert('Positon Deleted!');
                        // Optionally, you can redirect or remove the deleted item from the page
                        location.reload(); // Or use JavaScript to remove the deleted item from the DOM
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        const dataError=JSON.parse(xhr.responseText);
                        console.log(dataError);
                        alert(dataError.message);
                    }
                });
                })
                
                $('#confirmationModal').modal('hide');
                return false;
            });
            $('form#addPosition').on('submit',function(e){
                e.preventDefault()
                $.ajax({
                    url: $(this).attr('action'),    // URL to send the request to
                    type: $(this).attr('method'),   // Form method (POST with @method('DELETE'))
                    data: $(this).serialize(),      // Serialize the form data
                    success: function(response) {
                        // Handle success response (e.g., show a success message)
                        alert('Successfully Added new Positon!');
                        // Optionally, you can redirect or remove the deleted item from the page
                        location.reload(); // Or use JavaScript to remove the deleted item from the DOM
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        const dataError=JSON.parse(xhr.responseText);
                        console.log(dataError);
                        alert(dataError.message);
                    }
                });
            })
        })
    </script>
@endsection