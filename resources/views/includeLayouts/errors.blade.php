@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $errorsItem)
       <p> {{$errorsItem}} </p>
    @endforeach
</div>
    
@endif