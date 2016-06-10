<?php  
    $files = $_FILES['filename'];  
    //$name= 'asitela-'.time().'.jpg';  
    $name= 'classtable.jpg';  
    $form_data = $files['tmp_name'];  
    $s2 = new SaeStorage();  
    $img = new SaeImage();  
    
    //删除原有文件
    if($s2->fileExists('yogafile', $name) == true){
        if($s2->delete('yogafile', $name) === false){
            echo "上传失败！";
            return;
        }
    }
    
    $img_data = file_get_contents($form_data);//获取本地上传的图片数据  
    $img->setData($img_data);  
    //$img->resize(180,180); //图片缩放为180*180  
    $img->improve();//提高图片质量的函数  
    $new_data = $img->exec(); // 执行处理并返回处理后的二进制数据  
    $s2->write('yogafile',$name,$new_data);//将public修改为自己的storage 名称  
    $url= $s2->getUrl('yogafile',$name);//将public修改为自己的storage 名称echo "文件名：".$name."<br/>";  
    echo "Image url:".$url."<br/>";  
    echo "<img src='$url' />";  
?>  