<?php
if(Session::has('locale') && Session::get('locale') == "ae")
{
  $dir = "rtl";
  $css = "css-rtl";
}
else
{
  $dir = "ltr";
  $css = "css";
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="{{ $dir }}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Make Order</title>
<link rel="apple-touch-icon" href="{{ Asset('app-assets/images/ico/apple-icon-120.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ Asset('app-assets/images/ico/favicon.ico') }}">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet') }}">

<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/extensions/tether-theme-arrows.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/extensions/tether.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/vendors/css/extensions/shepherd-theme-default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{Asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">


<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//bootstrap-extended.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//colors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//components.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//themes/semi-dark-layout.css') }}">

<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//core/colors/palette-gradient.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//pages/dashboard-analytics.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//pages/card-analytics.css') }}">
<link rel="stylesheet" type="text/css" href="{{ Asset('app-assets/'.$css.'//plugins/tour/tour.css') }}">

<link rel="stylesheet" type="text/css" href="{{ Asset('assets/'.$css.'//style.css') }}">
@yield('css')

</head>

<body>