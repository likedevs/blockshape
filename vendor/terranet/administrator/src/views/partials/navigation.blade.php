<!-- search form -->
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    {{-- {{ dd($navigation) }}; --}}

    @foreach($navigation->getPages() as $page => $options)
        <li class="{{ (isset($options['pages']) ? 'treeview active' : '') }}">
            <a href="{{ isset($options['link']) ? $options['link'] : '#' }}">
                <i class="fa {{ $options['icon'] }}"></i>
                <span>{{ $options['title'] }}</span>
                @if (isset($options['pages']))
                    <i class="fa fa-angle-left pull-right"></i>
                @endif
            </a>
            @if (isset($options['pages']))
                <ul class="treeview-menu" style="display: block">
                    @foreach($options['pages'] as $page)
                        <li class="{{ ($page['page'] == $navigation->getCurrentModule() ? 'active' : '') }}"><a href="{{ $page['link'] }}"><i class="fa {{ $page['icon'] }}"></i> {{ $page['title'] }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
