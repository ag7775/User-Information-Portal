<?php 

  include 'core/init.php' ;
  	protect_page();
  include 'includes/overall/header.php' ;
?>

		<h1>Downloads</h1>
<?php
		if(!empty($_GET['file']))
		{
			$filename=basename($_GET['file']);
			$filepath='downloads/'.$filename;
			if(!empty($filename) && file_exists($filepath))
			{
				header("Cache-Control:public");
				header("Content-Description:File Transfer");
				header("Content-Disposition:attachment; filename=$filename");
				header("Content-Type:application/zip");
				header("Content-Transfer-Encoding:binary");
				readfile($filepath);
				exit();
			}
		}

?>
	<a href="download.php?file=2.pdf">Click here to download</a>
<?php 

include 'includes/overall/footer.php' 
?>