@component('mail::table')
    | Id    | Name   | Category  | User  |
    |:------:   |:-----------   |:--------: |:--------: |
    @foreach($products as $product)
        | {{$product->id}}     | {{$product->name}} |        {{$product->category->name}} |{{$product->category->user->name}} |
    @endforeach
@endcomponent