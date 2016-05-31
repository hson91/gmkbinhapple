$(document).ready(function(){
    $('.ordering').change(function(){
        $.ajax({
            type:'post',
            url:$(this).attr('data-href'),
			data:{'ordering':$(this).val()}
        });
        return false; 
    }); 
});