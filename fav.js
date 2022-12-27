
(function($){
    $('.addfavori').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                if(confirm(data.message)){
                    alert(data.message);
                }else{
                    $('#countfavori').empty().append(data.count);
                }
            }
        },'json');
        return false;
    })
})(jQuery);