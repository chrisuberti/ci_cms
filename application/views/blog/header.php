<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title><?php if( isset($title) && $title !== NULL ) { echo $title;} ?></title>

<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
<meta name="author" content="Pisyek Kumar" />
<meta name="description" content="This is a site demo on how to create a simple CodeIgniter blog" />
<meta name="keywords" content="codeigniter, blog, pisyek, tutorial" />
<meta name="robots" content="index, follow, noarchive" />
<meta name="googlebot" content="noarchive" />

</head>

<body>
    <?php $this->load->view('blog/navbar');?>