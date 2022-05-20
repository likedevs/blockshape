@extends('administrator::index')

@section('js')
<script>
    $(document).on('click', '.product-delete', function() {
        if (! confirm('Are you sure?')) {
            return false;
        }

        var el = $(this), link = el.closest('a');
        var rId = parseInt(link.data('recipe')),
            pId = parseInt(link.data('product'));

        $.get('{{ route('admin.recipes.deleteProduct') }}', {
            recipe: rId,
            product: pId
        }, function() {
            el.closest('tr').remove();
        });

        return false;
    }).on('click', '.add_recipe_product_btn', function() {
        var el = $(this);
        var elements = $(this).closest('div').find('input,select').serialize();

        $.post('{{ route('admin.recipes.addProduct') }}', elements, function(response) {
            if (response && response.hasOwnProperty('data')) {
                var data = response.data;
                var table = el.closest('.add-product-form').siblings('table');

                $('<tr><td>' + data.product.name + '</td><td>' + data.weight + ' ' + data.units + '</td><td><a href="#" data-recipe="' + data.recipe_id + '" data-product="' + data.product_id + '"><i class="fa fa-trash-o product-delete"></i></a></td></tr>').appendTo(table.find('tbody'));
            }
        }).fail(function(response) {
            response = response.responseJSON;

            var errors = [];
            for(var f in response) {
                errors.push((response[f]).join("\n"));
            }
            alert('Errors' + "\n====================\n" + errors.join("\n"));
        });

        return false;
    })
</script>
@append