<p><a href="#" onclick="$(this).parent().next().removeClass('hidden'); $(this).hide();"><i class="fa fa-plus"></i> Add product</a></p>
<div class="hidden add-product-form">
    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
    <table class="table">
        <tr>
            <th>Product</th>
            <th style="width: 100px;">Weight</th>
            <th style="width: 100px;">Units</th>
            <th style="width: 80px;"></th>
        </tr>
        <tr>
            <td>
                <?= Form::select("product_id", app('products_list'), null, ['class' => 'form-control', 'required' => 'required'])?>
            </td>
            <td><input type="number" required class="form-control"  name="weight" id="weight"></td>
            <td><?= Form::select("units", array_combine($units = ['g', 'ml', 'piece'], $units), null, ['class' => 'form-control', 'required' => 'required']) ?></td>
            <td>
                <button type="button" class="btn btn-primary add_recipe_product_btn">Add</button>
            </td>
        </tr>
    </table>
</div>