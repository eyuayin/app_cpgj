var btn = $('#uploadBtn');
new AjaxUpload(btn, {
action:url,
name:'files',
multiple: true,
responseType: 'json',
onSubmit : function(file, ext) {
if (ext && /^(JPG|PNG|JPEG|GIF|BMP|jpg|pne|jpeg|gif|bmp)$/.test(ext)){
this.setData({
'info':'文件类型正确'
});
} else {
sys_msg('文件类型错误', '只能上传类型为：JPG|PNG|JPEG|GIF|BMP 的图片文件!');
return false;               
}
$('#uploads_span').html(sys_loading_img);
this.disable();
},
onComplete: function(files, response){
if ('error' == response.result)
sys_msg('失败', '上传文件失败，请检查文件名是否正确!');
else if ('file_type_error' == response.result)
sys_msg('文件类型错误', '只能上传类型为：JGP、GIF、BMP、ICO、PNG的文件!');
else {
var tr = $('#' + color);// 找到对应的TR
$.each(response.list,function(e) {
tr.find('img.img').attr({'src':'upload/commodity/'+ this.uuid +'.' + this.ext}).end()
  .find('input.img-path').attr({'value': this.uuid +'.' + this.ext}).end();
return false;//这里只取第一张
});
this.enable();
}  
}
});