<head>
<?php require_once('favicon.html'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title><?php echo @$title; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />    
  <!--  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">-->
	<link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<!--<link rel="stylesheet" href="css/fullcalendar.css">
	<link href="css/widgets.css" rel="stylesheet">-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
	<!--<link href="css/xcharts.min.css" rel=" stylesheet">-->	
	<link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">
  </head>
<!--<i class=" "-->

  <link href="../../sweetalert-js/sweetalert.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../sweetalert-js/sweetalert.min.js"></script>
<script type="text/javascript" src="../../sweetalert-js/sweetalert.js"></script>
<script type="text/javascript">
function sweetUnpre(msg){
	swal(
	  msg
	);
}
function sweetError(msg){
	swal(
	  'Oops...',
	  msg,
	  'error'
	);
}


function sweetGood2(){
swal({
  title: '<i>HTML</i> <u>example</u>',
  type: 'success',
  html:
    'You can use <b>bold text</b>, ' +
    '<a href="//github.com">links</a> ' +
    'and other HTML tags',
  showCloseButton: true,
  showCancelButton: true,
  confirmButtonText:
    '<i class="fa fa-thumbs-up"></i> Great!',
  cancelButtonText:
    '<i class="fa fa-thumbs-down"></i>'
})
}
</script>
