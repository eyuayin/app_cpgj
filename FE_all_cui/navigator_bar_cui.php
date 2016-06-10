<?php
print <<<EOT
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"> 天环瑜伽馆会员管理系统 </a>
          <div class="btn-group pull-right">
			<a class="btn" href="my-profile.html"><i class="icon-user"></i> Admin</a>
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
			  <!--<li><a href="my-profile.html">Profile</a></li>-->
              <!--<li class="divider"></li>-->
              <li><a href="destroy.php">Logout</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">会员信息 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-user_cui.php">新增会员</a></li>
					<li class="divider"></li>
					<li><a href="users_cui.php">查看所有会员</a></li>
                    <li class="divider"></li>
                    <li><a href="search_and_update_user_cui.php">查找会员</a></li>
                    <li class="divider"></li>
                    <li><a href="delete-user_cui.php">删除会员</a></li>
				</ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">预约管理 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-role_cui.php">预约课程</a></li>
					<li class="divider"></li>
					<li><a href="query_booked_class_cui.php">预约查询</a></li>
				</ul>
			  </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">课程管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-class_cui.php">新建课程</a></li>
                        <li class="divider"></li>
                        <li><a href="search_and_update_class_cui.php">课程查询</a></li>
                        <li class="divider"></li>
                        <li><a href="all_class_info_cui.php">所有课程列表</a></li>
                        <li class="divider"></li>
                        <li><a href="upload_class_cui.php" target="_blank">导入本月课程</a></li>
                 </ul>
                </li>
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">小班课管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-class_cui.php">新建小班课</a></li>
                        <li class="divider"></li>
                        <li><a href="search_and_update_class_cui.php">小班课查询</a></li>
                        <li class="divider"></li>
                        <li><a href="all_class_info_cui.php">小班课预约</a></li>
                 </ul>
                </li>
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">私教管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-class_cui.php">新建私教课程</a></li>
                        <li class="divider"></li>
                        <li><a href="search_and_update_class_cui.php">私教课程查询</a></li>
                        <li class="divider"></li>
                        <li><a href="all_class_info_cui.php">私教预约</a></li>
                    </ul>
                </li>
				<li class="dropdown"><a href="index.php">切换君子兰馆</a>
			    </li>
                </ul>

          </div>
        </div>
      </div>
    </div>
EOT;
?>