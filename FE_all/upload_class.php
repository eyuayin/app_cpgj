<?php
session_start();
if (isset($_SESSION['valid_user'])){
print <<<EOT
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8" />
        <title>课程信息导入 | 君子兰会馆</title>
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <script src="js/script.js"></script>
    </head>
    <body>
        <header>
            <h2>课程信息导入</h2>
            <a class="stuts"><span>君子兰会馆</span></a>
        </header>
        <div class="container">
            <div class="contr"><h2>请选择课程信息的excel文件(.xlsx或.xls文件)</h2></div>

            <div class="upload_form_cont">
                <form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php">
                    <div>
                        <div><label for="image_file">请选择课程信息文件</label></div>
                        <div><input type="file" name="image_file" id="image_file" onchange="fileSelected();" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/></div>
                    </div>
                    <div>
                        <input id="upload_btn" type="button" value="Upload" onclick="startUploading()" disabled="true"/>
                    </div>
                    <div id="fileinfo">
                        <div id="filename"></div>
                        <div id="filesize"></div>
                        <div id="filetype"></div>
                        <div id="filedim"></div>
                    </div>
                    <div id="error">只能上传excel文件!</div>
                    <div id="error2">上传文件时出错！</div>
                    <div id="abort">用户取消上传或浏览器失去网络连接！</div>
                    <div id="warnsize">上传文件太大，请选择小于2MB的文件！</div>

                    <div id="progress_info">
                        <div id="progress"></div>
                        <div id="progress_percent">&nbsp;</div>
                        <div class="clear_both"></div>
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                            <div id="b_transfered">&nbsp;</div>
                            <div class="clear_both"></div>
                        </div>
                        <div id="upload_response"></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
EOT;
}
else{
    echo "please login first!";
    echo "<br/>";
    echo "<a href='login.html'>login</a>";
}
?>