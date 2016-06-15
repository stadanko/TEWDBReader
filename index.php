<?php 

	$db = "tewdb.mdb";
	$companies = "Companies";
	
	if (!file_exists($db)) {
		die("Could not find database file.");
	}
	
	$conn = odbc_connect("Driver={Microsoft Access Driver(*.mdb)};Dbq=$db", , );
	
	$sql = "SELECT $companies.[Name]
			FROM $db.$companies";
	
	$rs = odbc_exec($conn, $sql);
	
	if (!$rs) {
		exit("There is an error in the SQL!");
	}
	
	$data = array();
	$i = 0;
	
	while ($row = odbc_fetch_array($rs)) {
		$data[$i] = $row;
		$i++;
	}
	
	odbc_close($conn);
		
?>

<!DOCTYPE html>
<html lang="en">
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>PMI Buddy - An Integration Tracking Tool</title>
 <!-- Bootstrap -->
 <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media
queries -->
 <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
 <!--[if lt IE 9]>
 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></
script>
 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/
respond.min.js"></script>
 <![endif]-->

 <style></style>
 </head>
 <body data-spy="scroll" data-target=".navbar-collapse">
 <!--Navigation-->
 <div class="navbar navbar-inverse navbar-fixed-top">
	 <div class="container">
	 	 	 <div class="navbar-header">
	 	 	 	 <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	 	 	 	 	 <span class="icon-bar"></span>
	 	 	 	 	 <span class="icon-bar"></span>
	 	 	 	 	 <span class="icon-bar"></span>
	 	 	 	 </button>
	 	 	 	 <a class="navbar-brand"><span class="blue">PMI</span> <span class="white">Buddy</span></a>
	 	 	 </div>
	 	 	 	
	 	 	 <div class="collapse navbar-collapse">
	 	 	 	 <form class="navbar-form navbar-right" method="post">
	 	 	 	 	 <div class="form-group">
	 	 	 	 	 	 <input type="email" name="loginemail" placeholder="Email" class="form-control" value="<?php echo addslashes($_POST['loginemail']); ?>"/>
	 	 	 	 	 </div>
	 	 	 	 	 <div class="form-group">
	 	 	 	 	 	 <input type="password" name="loginpassword" placeholder="Password" class="form-control" />
	 	 	 	 	 </div>
	 	 	 	 	 <input type="submit" name="submit" class="btn btn-primary" value="Log In" />
	 	 	 	 </form>
	 	 	 	 	
	 	 	 </div>
	 </div>
 </div>

 <div class="container contentContainer" id="topContainer">

	 <div class="row">
	 	 	
	 	 	 <div class="col-md-6 col-md-offset-3" id="topRow">
		 	 	 	 	 	
	 	 	 	<?php //echo $data; ?>
				
	 	 	 </div>
	 	 	
	 	 	
	 </div>
	
 </div>

 <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="js/bootstrap.min.js"></script>

 <script>

 	$(".contentContainer").css("min-height",$(window).height());
 
 </script>
 </body>
</html>