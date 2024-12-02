<?php
		
	@$halaman = $_GET['halaman'];

	if($halaman =="departemen")
	{
		include "modul/departemen/departemen.php";

		//echo "Tampil Halaman Modul Departemen";
	}
  
  	 elseif($halaman =="pengirim_surat"){
  	 	include "modul/pengirim_surat/pengirim_surat.php";
  		
  	}
  	elseif ($halaman =="arsip_surat")
  	{
		if (@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus") {
			include "modul/arsip/form.php";
		}else{
			include "modul/arsip/data.php";
		}
	
	}
	else
	    {
	  		//echo "Tampil Halaman Home";
	  		include "modul/home.php";
	  	}
	 
	  ?>