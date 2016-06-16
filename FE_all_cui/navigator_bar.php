<?php
print <<<EOT
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner" >
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"> 翠屏国际馆会员管理系统 </a>
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
             <li class="dropdown"><a href="index_new.php" class="dropdown-toggle" >首页</a>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">会员信息 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-user.php">新增会员</a></li>
					<li class="divider"></li>
					<li><a href="users.php">查看所有会员</a></li>
                    <li class="divider"></li>
                    <li><a href="search_and_update_user.php">查找会员</a></li>
                    <li class="divider"></li>
                    <li><a href="delete-user.php">删除会员</a></li>
				</ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">预约管理 <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="new-role.php">预约课程</a></li>
					<li class="divider"></li>
					<li><a href="query_booked_class.php">预约查询</a></li>
				</ul>
			  </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">课程管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-class.php">新建课程</a></li>
                        <li class="divider"></li>
                        <li><a href="search_and_update_class.php">课程查询</a></li>
                        <li class="divider"></li>
                        <li><a href="all_class_info.php">所有课程列表</a></li>
                        <li class="divider"></li>
                        <li><a href="upload_class.php" target="_blank">导入本月课程</a></li>
                        <!--<li class="divider"></li>-->
                        <!--<li><a href="upload_class_img.php" target="_blank">导入本月课表图片</a></li>-->
                 </ul>
                </li>
				<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">精品课管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">                        
                        <li><a href="booking_class_min_new.php">精品课新建及预约</a></li>
                       
                    </ul>
                </li>
				 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">私教管理 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="booking_class_private_new.php">私教预约</a></li>
                    </ul>
                </li>
				
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">选择会馆<b class="caret"></b></a>
                    <ul class="dropdown-menu">                        
                        <li><a href="../FE_all/index.php">君子兰会馆</a></li>
                        <li class="divider"></li>
                        <li><a href="index.php">翠屏国际会馆</a></li>
                        
                    </ul>
                </li>
                </ul>

          </div>
        </div>
      </div>
    </div>
EOT;
?>