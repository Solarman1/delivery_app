
@extends('layouts.app')

@section('content')
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <!-- <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='/addCategory'">Добавить категорию</button>-->
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">
Добавить категорию
</button>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="categoryModalLabel">Modal title</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<!-- Modal BODY  START-->
  <div class="modal-body">
      <div class="container">
          <div class="card">
              <div class="card-header">
                  <form action="https://api.ochag55.ru/category" method="post" enctype="multipart/form-data">
                      @csrf
                      <h1 class="h2">Введите название категории</h1>
                      <p></p>
                      <p>Картинка категории:
                        <input type="file" name="img">
                      </p>
                      <input name="categoryName" class="form-control">
                      <button type="submit" class="btn btn-success">Сохранить</button>
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


    </div>
  </div>


<div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>№</th>
          <th>Название категории</th>
          <th>img</th>
          <th>Действие</th>

        </tr>
      </thead>
      <tbody>
      @if (!empty($categorys))
          @foreach($categorys as $row)
              <tr>
                  <td>{{$row->id}}</td>
                  <input name = "hiddenCategoryId" type="hidden" value="{{$row->id}}">
                  <td><a class="nav-link" href="/admin/category/{{$row->id}}">{{$row->name}}</a></td>
                  <input id = "pName{{$row->id}}" name = "pName" type="hidden" value="{{$row->name}}">
                  <td><img class="card-img-top" alt="" style="height: 150px; width: 150px; margin: auto; display: block;" src="{{asset('/storage/categoryImages/'.$row->image)}}" data-holder-rendered="true"></td>
                  <input id = "pImage{{$row->id}}" type="hidden" name = "imageHidden" value="{{$row->image}}">
                  <td>
                      <button id = "{{$row->id}}" name = "modelButton" type="button"  class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#categoryEditModal">Редактировать</button>
                      <form action="/deleteCategory" method="post">
                          @csrf
                          <input id = "pCategory{{$row->id}}" name = "categoryId" type="hidden" value="{{$row->id}}">
                          <button type="submit" class="btn btn-sm btn-outline-secondary">Удалить</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      @endif
      </tbody>
    </table>
  </div>

  <!-- Modal edit start -->
<div class="modal fade" id="categoryEditModal" tabindex="-1" role="dialog" aria-labelledby="categoryEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="categoryEditModalLabel">Введите новое название категории</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <!-- Modal BODY  START-->
    <div class="modal-body">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <form action="https://api.ochag55.ru/category" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                        <h1 class="h2"></h1>
                        <p></p>
                        <input id="categoryNameId" name="categoryName" class="form-control">
                        <input id="editCategoryId" name="categoryId" class="form-control" type="hidden">
                        <input type="file" name="img">
                        <input id = "imgEditHidden" type="hidden" name="imgEditHidden">
                        <button type="submit" class="btn btn-success">Сохранить</button>
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

<script>

      const nameEditId        = document.getElementById('categoryNameId');
      const editCategoryId    = document.getElementById('editCategoryId');
      const modelButton       = document.getElementsByName('modelButton');
      const imgEdit           = document.getElementById('imgEditHidden');

      const categoryId    = document.getElementsByName('hiddenCategoryId');
      const pName         = document.getElementsByName('pName');
      const pImage       = document.getElementsByName('imageHidden');

      var cartData;
      var arrCartData = [];

      console.log(pName.length);
      for(let i = 0; i < pName.length; i++)
      {
        cartData = {
          categoryId  : categoryId[i].value,
          pName       : pName[i].value,
          pImage      : pImage[i].value,
        };
        arrCartData[i] = cartData;
      }

      console.log(arrCartData);

      modelButton.forEach((element) => {
        var modelButtonId = document.getElementById(element.id);
        console.log(modelButton.id);
        modelButtonId.addEventListener('click', (event) => {
          for(let i = 0; i < arrCartData.length; i++)
          {
            if(modelButtonId.id == arrCartData[i].categoryId )
            {
              nameEditId.value         = arrCartData[i].pName;
              editCategoryId.value     = arrCartData[i].categoryId;
              imgEdit.value           = arrCartData[i].pImage;
            }
          }
        });
      });
    </script>
@endsection
