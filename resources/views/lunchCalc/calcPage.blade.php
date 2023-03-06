@extends('layouts.app')

@section('content')
<h2> Компоненты калькулятора </h2>
<br>
<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calcModal">
        Добавить комплекс
    </button>
</div>
<br>

<div>
    @foreach($calcs as $row) 
    <br>

        <form action="/edit-calc-type" method="post" enctype="multipart/form-data">
          @csrf
            <input name="id" type="hidden" value="{{$row->id}}">
            <input name="lunch_title" value="{{$row->title}}">
            <input name="lunch_price" value="{{$row->price}}">

            <button 
                type="submit"  
                class="btn btn-success">
            Редактировать
            </button> 
        </form>

        {{-- <a href="/delete-calc/{{$row->id}}" class="badge badge-danger">Удалить</a> --}}
    <br>
    @endforeach 
</div>


  <!-- Modal -->
<div class="modal fade" id="calcModal" tabindex="-1" role="dialog" aria-labelledby="calcModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calcModalLabel">Данные комплекса</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <!-- Modal BODY  START-->
      <div class="modal-body">
          <div class="container">
              <div class="card"> 
                  <div class="card-header">
                      <form action="/create-calc" method="post" enctype="multipart/form-data">
                          @csrf
                          <br>
                          <input name="lunch_title" placeholder="название" class="form-control">
                          <br>
                          <input name="lunch_price" placeholder="цена" class="form-control">
                          <br>
                          <button type="submit" class="btn btn-success">Сохранить</button>
                          <br>
                      </form>
                  </div>                                                    
               </div>
           </div>       
      </div>
    <!-- Modal BODY  END-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
    </div>
    <!-- Modal END-->
@endsection