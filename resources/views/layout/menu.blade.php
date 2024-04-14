@php($page = Request::segment(1))
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
<div class="navbar-header">
<ul class="nav navbar-nav flex-row">
<li class="nav-item mr-auto"><a class="navbar-brand" href="{{ Asset('home') }}">
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
<li><a href="{{ Asset('home') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.home')</span></a>
</li>
<li><a href="{{ Asset('setting') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="eCommerce">@lang('app.setting')</span></a>
</li>
</ul>
</li>
<li class="@if($page == 'language') active @endif nav-item"><a href="{{ Asset('language') }}"><i class="fa fa-flag"></i><span class="menu-title" data-i18n="Email">@lang('app.app_lang')</span></a></li>

<li class="@if($page == 'slider') active @endif nav-item"><a href="{{ Asset('slider') }}"><i class="fa fa-image"></i><span class="menu-title" data-i18n="Email">@lang('app.home_slider')</span></a></li>

<li class="@if($page == 'plan') active @endif nav-item"><a href="{{ Asset('plan') }}"><i class="fa fa-credit-card-alt"></i><span class="menu-title" data-i18n="Email">@lang('app.sub_plan')</span></a></li>

<li class="@if($page == 'fiance') active @endif nav-item"><a href="{{ Asset('fiance') }}"><i class="fa fa-money"></i><span class="menu-title" data-i18n="Email">@lang('app.fiance')</span></a></li>

<li class="@if($page == 'city' || $page == 'store' || $page == 'cate') active @endif nav-item"><a href="#"><i class="fa fa-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('app.manage_stores')</span></a>
<ul class="menu-content">

<li><a href="{{ Asset('cate') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.store_category')</span></a></li>

<li><a href="{{ Asset('store') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.stores')</span></a>
</li>

</ul>
</li>

<li class="@if($page == 'page') active @endif nav-item"><a href="{{ Asset('page') }}"><i class="fa fa-file"></i><span class="menu-title" data-i18n="Email">@lang('app.page_text')</span></a></li>

<li class="@if($page == 'delivery') active @endif nav-item"><a href="{{ Asset('delivery') }}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Email">@lang('app.delivery_staff')</span></a></li>

<li class="@if($page == 'offer') active @endif nav-item"><a href="{{ Asset('offer') }}"><i class="fa fa-tags"></i><span class="menu-title" data-i18n="Email">@lang('app.coupon')</span></a></li>

<li class="@if($page == 'text') active @endif nav-item"><a href="{{ Asset('text') }}"><i class="fa fa-language"></i><span class="menu-title" data-i18n="Email">@lang('app.app_text')</span></a></li>

<li class="@if($page == 'order') active @endif nav-item"><a href="#"><i class="fa fa-shopping-cart"></i><span class="menu-title" data-i18n="Dashboard">@lang('app.manage_orders')</span></a>
<ul class="menu-content">

<li><a href="{{ Asset('order?status=0') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.new_orders')</span></a>

<li><a href="{{ Asset('order?status=1') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.running_order')</span></a>

<li><a href="{{ Asset('order?status=5') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.completed_orders')</span></a>

<li><a href="{{ Asset('order?status=2') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Analytics">@lang('app.cancelled_orders')</span></a>


</ul>
</li>

<li class="@if($page == 'push') active @endif nav-item"><a href="{{ Asset('push') }}"><i class="fa fa-bell"></i><span class="menu-title" data-i18n="Email">@lang('app.push')</span></a></li>

<li class="@if($page == 'appUser') active @endif nav-item"><a href="{{ Asset('appUser') }}"><i class="fa fa-users"></i><span class="menu-title" data-i18n="Email">@lang('app.app_user')</span></a></li>

<li class="@if($page == 'report') active @endif nav-item"><a href="{{ Asset('report') }}"><i class="fa fa-file"></i><span class="menu-title" data-i18n="Email">@lang('app.reporting')</span></a></li>

<li class="@if($page == 'deposits') active @endif nav-item"><a href="{{ Asset('deposits') }}"><i class="fa fa-money"></i><span class="menu-title" data-i18n="Email">@lang('app.deposit')</span></a></li>

<li class=" nav-item"><a href="{{ Asset('logout') }}"><i class="fa fa-sign-out"></i><span class="menu-title" data-i18n="Email">@lang('app.logout')</span></a></li>

</ul>
</div>
</div>
