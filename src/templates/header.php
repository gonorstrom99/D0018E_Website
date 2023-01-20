<!doctype html>
<html class="no-js" lang="">

<?php
  $default_header = array(
    "title" => "",
    "description" => "",
    "type" => "",
    "url" => "",
    "image" => "",
    "theme-color" => "#fafafa"
  );
  if (!array_key_exists('header', get_defined_vars()))
    $header = array();

  if ($header !== null)
    $header = array_merge($header, $default_header);
  else
    $header = $default_header
?>

<head>
  <meta charset="utf-8">
  <title><?php echo $header['title']?></title>
  <meta name="description" content="<?php echo $header['description']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="<?php echo $header['title']?>">
  <meta property="og:type" content="<?php echo $header['type']?>">
  <meta property="og:url" content="<?php echo $header['url']?>">
  <meta property="og:image" content="<?php echo $header['image']?>">

  <link rel="manifest" href="../public/site.webmanifest">
  <link rel="apple-touch-icon" href="../public/img/icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="../public/css/normalize.css">
  <link rel="stylesheet" href="../public/css/main.css">

  <meta name="theme-color" content="#fafafa">
</head>


<body>
