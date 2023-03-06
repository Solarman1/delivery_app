{{$name}}
{{$body}}

Заказ: 
@foreach ($products as $item)

      Позиция: {{$item['name']}} Количество: {{$item['quantity']}}
       
@endforeach
