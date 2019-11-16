<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <title>Adminizio Lite</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/reset.css">
  <link rel="stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/main.css">
  <link rel="stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/2col.css" title="2col">
  <link rel="alternate stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/1col.css" title="1col">
  <!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="css/main-ie6.css" /><![endif]-->
  <link rel="stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/style.css">
  <link rel="stylesheet" media="screen,projection" type="text/css" href="assetsAdmin/css/mystyle.css">
  <script type="text/javascript" src="assetsAdmin/js/jquery.js"></script>
  <script type="text/javascript" src="assetsAdmin/js/switcher.js"></script>
  <script type="text/javascript" src="assetsAdmin/js/toggle.js"></script>
  <script type="text/javascript" src="assetsAdmin/js/ui.core.js"></script>
  <script type="text/javascript" src="assetsAdmin/js/ui.tabs.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".tabs > ul").tabs();
    });
  </script>
</head>

<body>
  <div id="main">
    <!-- Tray -->
    <div id="tray" class="box">
      <p class="f-left box">
        <!-- Switcher -->
        <span class="f-left" id="switcher"> <a href="javascript:void(0);" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="assetsAdmin/design/switcher-1col.gif" alt="1 Column"></a> <a href="javascript:void(0)" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="assetsAdmin/design/switcher-2col.gif" alt=""></a> </span>        Project: <strong>Gestion de droits d'acces</strong> </p>
      <p class="f-right">User: <strong><a href="#">Administrator</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="?controller=Home&action=logout" id="logout">Log out</a></strong></p>
    </div>
    <!--  /tray -->
    <hr class="noscreen">
    <!-- Menu --
    <!-- /header -->
    <hr class="noscreen">
