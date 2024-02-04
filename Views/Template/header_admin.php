<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    <?= $data['page_title']; ?>
  </title>
  <!-- Bootstrap -->
  <link href="<?= media(); ?>/vendors/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
  <!-- mis estilos personalisados -->
  <link href="<?= media(); ?>/vendors/bootstrap/dist/css/style.css" rel="stylesheet">
  <!-- jquery -->
  <link href="<?= media(); ?>/build/css/jquery.mCustomScrollbar.css" rel="stylesheet">
  <link href="<?= media(); ?>/build/css/jquery-ui.min.css" rel="stylesheet">
  <!-- selectpicker -->
  <link href="<?= media(); ?>/js/plugins/selectpicker/bootstrap-select.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?= media(); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?= media(); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="<?= media(); ?>/build/css/custom.css" rel="stylesheet">
  <!-- dataTable -->
  <link href="<?= media(); ?>/dataTables/datatables.min.css" rel="stylesheet" />
</head>

<?php require_once("nav_admin.php"); ?>