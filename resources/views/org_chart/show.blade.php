@extends('layout.main')
@section('content')
<div class="container mt-5">
        <h4>Form View</h4>
        <div class="row justify-content-center">
            <div class="col col-md-4">
                <form action="/api/positions/{{$position->id}}" id="addPosition"  method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" value="{{$position->name}}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Reports to</label>
                        <select class="form-select" name="reports_to" aria-label="Default select example">
                            <option value=""></option>
                            @foreach ($positions as $sub_position)
                                <option {{$position->reports_to==$sub_position->id ? 'selected' : '' }} value="{{$sub_position->id}}">{{$sub_position->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
</div>
<script>
    $(document).ready(function(){
        $('form').on('submit',function(e){
            e.preventDefault();
            const form=$(this);
            $.ajax({
                url: form.attr('action'),    // URL to send the request to
                type: form.attr('method'),   // Form method (POST with @method('DELETE'))
                data: form.serialize(),      // Serialize the form data
                success: function(response) {
                    // Handle success response (e.g., show a success message)
                    alert('Updated Successfully!');
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
            return false;
        })
    })
</script>
@endsection