<table class="table products-table">
    @foreach($products as $product)
    <tr>
        <td>{{ $product->product->name }}</td>
        <td style="width: 10%;">{{ $product->weight }} {{ $product->units }}</td>
        <td style="width: 10%;"><a href="#" data-recipe="{{ $recipe->id }}" data-product="{{ $product->product_id }}"><i class="fa fa-trash-o product-delete"></i></a></td>
    </tr>
    @endforeach
</table>