$(document).ready(function(){
    $('.status').click(function(){
        var currentID = $(this).attr('id');
        $('body').css('cursor', 'wait');
        $.ajax({
            type:'post',
            url:$(this).attr('href'),
            success:function(data){
                $('body').css('cursor', 'default');
                data = $.parseJSON(data);
                if(data['status'] == 1){
                    $('#'+currentID).html('<i>&#xf00c;</i>');
                }else{
                    $('#'+currentID).html('<i>&#xf00d;</i>');
                }
                if(typeof(data['update']) != "undefined"){
                    $.fn.yiiGridView.update('data-grid');
                }
            }
        });
        return false; 
    });
});