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
                    $('#total').empty().append(data.total);
                    $('#count').empty().append(data.count);
                }
            }
        },'json');
        return false;
    })
})(jQuery);

(function($){
    $('.connect').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert('vous devez vous conecter');
            }else{
                if(confirm('vous devez vous conecter')){
                    location.href = 'connexion.php';
                }else{

                }
            }
        },'json');
        return false;
    })
})(jQuery);
