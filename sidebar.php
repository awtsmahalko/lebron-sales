<div id="sidebar-main" class="sidebar sidebar-default">
    <div class="sidebar-content">
        <ul class="navigation">
		<?php if($_SESSION['user_type'] == 0 ) {?>
            <li class="navigation-header">
                <span>Main</span>
                <i class="icon-menu"></i>
            </li>

            <li>
                <a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>

            <li class="navigation-header">
                <span>Forms</span>
                <i class="icon-menu"></i>
            </li>

            <li>
                <a href="#"><i class="fa fa-pencil"></i> <span>Product</span></a>
                <ul>
                    <li><a href="index.php?page=product">Item</a></li>
                    <li><a href="index.php?page=product-category">Category</a></li>
                </ul>
            </li>

            <li>
                <a href="index.php?page=receiving"><i class="fa fa-th"></i> <span>Receiving</span></a>
            </li>

            <li>
                <a href="index.php?page=sales"><i class="fa fa-heart"></i> <span>Sales</span></a>
            </li>

            <li>
                <a href="#"><i class="fa fa-area-chart"></i> <span>Reports</span></a>
                <ul>
                    <li><a href="index.php?page=inventory">Inventory</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-users"></i> <span>User</span></a>
                <ul>
                    <li><a href="index.php?page=personnel">Personnel</a></li>
                    <li><a href="index.php?page=accounts">Account</a></li>
                </ul>
            </li>
		<?php }else{?>
            <li class="navigation-header">
                <span>Main</span>
                <i class="icon-menu"></i>
            </li>

            <li>
                <a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="navigation-header">
                <span>Forms</span>
                <i class="icon-menu"></i>
            </li>
            <li>
                <a href="index.php?page=sales"><i class="fa fa-heart"></i> <span>Sales</span></a>
            </li>
		<?php } ?>
        </ul>
    </div>
</div>