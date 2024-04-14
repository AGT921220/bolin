@php($page = Request::segment(2))
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
<div class="navbar-header">
<ul class="nav navbar-nav flex-row">
<li class="nav-item mr-auto"><a class="navbar-brand" href="{{ Asset(env('store').'/home') }}">
<h2 class="brand-text mb-0" style="color:white"><i class="fa fa-clock-o"></i> <span id="shwTime"></span></h2>
</a></li>

<script>
var myVar = setInterval(myTimer, 1000);

function myTimer() {
    var d = new Date();
    document.getElementById("shwTime").innerHTML = d.toLocaleTimeString();
}
</script>

</ul>
</div>
<div class="shadow-bottom"></div>
<div class="main-menu-content">
<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
<li class="@if($page == 'home' || $page == 'setting') active @endif nav-item"><a href="{{ Asset('home') }}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('app.dashboard')</span></a>
<ul class="menu-content">
<li><a href="{{ Asset(env('store').'/home') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.home')</span></a>
</li>
<li><a href="{{ Asset(env('store').'/setting') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">@lang('app.setting')</span></a>
</li>
</ul>
</li>

<li class="@if($page == 'category') active @endif nav-item"><a href="{{ Asset(env('store').'/category') }}"><i class="fa fa-pencil-square-o"></i><span class="menu-title" data-i18n="Email">@lang('app.category')</span></a></li>

<li class="@if($page == 'addonCate') active @endif nav-item"><a href="{{ Asset(env('store').'/addonCate') }}"><i class="fa fa-pencil-square-o"></i><span class="menu-title" data-i18n="Email">@lang('app.add_category')</span></a></li>

<li class="@if($page == 'addon') active @endif nav-item"><a href="{{ Asset(env('store').'/addon') }}"><i class="fa fa-plus-square"></i><span class="menu-title" data-i18n="Email">@lang('app.addon')</span></a></li>

<li class="@if($page == 'item') active @endif nav-item"><a href="{{ Asset(env('store').'/item') }}"><i class="fa fa-list"></i><span class="menu-title" data-i18n="Email">@lang('app.products')</span></a></li>

<li class="@if($page == 'order') active @endif nav-item"><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title" data-i18n="Dashboard">@lang('app.menu_manage_orders')</span></a>
<ul class="menu-content">

<li><a href="{{ Asset(env('store').'/order?status=0') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.menu_new_orders')</span></a>

<li><a href="{{ Asset(env('store').'/order?status=1') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.running_order')</span></a>

<li><a href="{{ Asset(env('store').'/order?status=5') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.menu_completed_orders')</span></a>

<li><a href="{{ Asset(env('store').'/order?status=2') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.menu_cancelled_orders')</span></a>

</ul>
</li>

<li class="@if($page == 'delivery') active @endif nav-item"><a href="{{ Asset(env('store').'/delivery') }}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Email">@lang('app.delivery_staff')</span></a></li>


<li class="@if($page == 'user') active @endif nav-item"><a href="{{ Asset(env('store').'/user') }}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Email">@lang('app.menu_user')</span></a></li>

<li class="@if($page == 'report') active @endif nav-item"><a href="{{ Asset(env('store').'/report') }}"><i class="fa fa-file"></i><span class="menu-title" data-i18n="Email">@lang('app.menu_reporting')</span></a></li>


<li class=" nav-item"><a href="{{ Asset('logout') }}"><i class="fa fa-sign-out"></i><span class="menu-title" data-i18n="Email">@lang('app.logout')</span></a></li>

</ul>
</div>
</div>