@if (isset($filter) && count($filter))
<section class="content" id="scaffold-filter">
    <form action="" data-id="filter-form">
        <input type="hidden" name="sort_by" value="{{ app('scaffold.sortable')->getElement() }}" />
        <input type="hidden" name="sort_dir" value="{{ app('scaffold.sortable')->getDirection() }}" />
        @foreach($queryString->toArray() as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
        @endforeach
        <div class="row">
            <div class="col-xs-10">
                <div class="row">
                    @foreach($filter as $element)
                    <div class="col-xs-3">
                        <div class="form-group">
                            {!! $element->html() !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-xs-2">
                <input type="submit" value="Search" class="btn btn-block btn-lg btn-bitbucket" />
            </div>
        </div>
    </form>
</section>

@section('js')
@include('administrator::partials.htmlhandlers')
@stop

@endif