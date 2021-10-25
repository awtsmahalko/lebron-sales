<?php
	if($page == 'product'){
		require view.'product.php';
	}else if($page == 'product-category'){
		require view.'product_category.php';
	}else if($page == 'barcode'){
		require view.'barcode.php';
	}else if($page == 'receiving'){
		require view.'receiving.php';
	}else if($page == 'sales'){
		require view.'sales.php';
	}else if($page == 'add-sales'){
		require view.'add_sales.php';
	}else if($page == 'view-sales'){
		require view.'view_sales.php';
	}else if($page == 'inventory'){
		require view.'inventory.php';
	}else if($page == 'accounts'){
		require view.'accounts.php';
	}else if($page == 'personnel'){
		require view.'personnel.php';
	}else{
		if(!empty($page) or $page != $page){
			require view.'error/error.php';
		}else{
			require view.'dashboard.php';
		}
	}
	
 ?>
