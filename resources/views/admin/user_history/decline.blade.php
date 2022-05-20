@extends('administrator::layout')

@section('content')
    <table class="table">
        <tbody>
        <tr class=" ">
            <td style="width: 20%; min-width: 200px;">
                <label for="name">Decline reason</label>:
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">
                <input type="submit" name="save" value="Save" class="btn btn-bitbucket">
                <input type="submit" name="save_return" value="Save &amp; Return" class="btn btn-bitbucket">
                <input type="submit" name="save_create" value="Save &amp; Create new" class="btn btn-google-plus ">
            </td>
        </tr>
        </tbody>
    </table>
@append
