function card_type_change(){
    var select_card_type=$('#select_card_type').val();
    console.log("selected_card_type",select_card_type);
    if(select_card_type == '次卡' || select_card_type == '学期次卡' || select_card_type == '私教卡' || select_card_type == '精品课卡')
    {
        console.log("次卡");
        $('#total_times_div').show();
        $('#times_per_week_div').hide();
    }

    else if ( select_card_type == '年卡' || select_card_type == '半年卡' || select_card_type== '季卡' ||select_card_type== '月卡' ||select_card_type == '学期周卡')
    {
        console.log("时间卡");

        $('#total_times_div').hide();
        $('#times_per_week_div').show();
    }
    else if(select_card_type == '年卡(不限次)')
    {
        $('#total_times_div').hide();
        $('#times_per_week_div').hide();
    }
    else
      alert("请选择一个卡类型");
}
function active_change(){
    var value=$("#if_active").val();
    console.log("value",value);
    //卡被激活
    if (value==1) {
        console.log("xuanzhong");
        $('#begin_date_div').show();
        $('#end_date_div').show();


    }
    else if(value==0){
        console.log("不激活");
        $('#begin_date_div').hide();
        $('#end_date_div').hide();
        $('#total_times_div').hide();
        $('#times_per_week_div').hide();
    }
    else
        alert("请选择卡是否被激活！");

};


$(document).ready(function () {
    console.log("ion");
    $("#times_per_week_div").hide();
    $("#total_times_div").hide();
    

});
