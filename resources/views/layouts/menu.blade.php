<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <li class="{{ Route::getCurrentRoute()->getPath() == 'types' ? ' active' : '' }}"><a href="{{ url('/types') }}"><span>Types</span></a></li>
</ul>
