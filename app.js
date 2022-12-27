(function($){
    $('.addpanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                if(confirm(data.message + ' voulez vous consulter votre panier?')){
                    location.href = 'panier.php';
                }else{
                    $('#totalpanier').empty().append(data.total);
                    $('#countpanier').empty().append(data.count);
                }
            }
        },'json');
        return false;
    })
})(jQuery);



