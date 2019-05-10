@component('mail::table')
    | id    | Name   | Category  |
    |:------:   |:-----------   |:--------: |
    @foreach($products as $product)
        | {{$product->id}}     | {{$product->name}} |        {{$product->category->name}} |
    @endforeach
@endcomponent