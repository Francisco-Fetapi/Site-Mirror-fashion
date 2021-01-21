$(function(){
//    $(window).resize(function(){
//        $('h4:eq(0)').html(window.innerWidth+" px");
//    })

    $('#btnLogout').click(function(e){
        e.preventDefault();
            $.ajax({
                url:'terminar_sessao.php',
                type:'get',
                dataType:'html',
                data:{
                    'terminar':true
                }
            }).done(function(res){
                window.location.href = 'login.php';
            })
    })

    // marcar o item do menu atual.
    var endereco = window.location.href;
    if(endereco.includes('home')){
        $("#menu a:eq(0)").addClass('atual');
    }else if(endereco.includes('perfil')){
        $("#menu a:eq(1)").addClass('atual');
    }else if(endereco.includes('sobre')){
        $("#menu a:eq(2)").addClass('atual');
    }

    $('.ic').click(function(){
        var id_produto = +$(this).attr('data-id');
        
        if(!$(this).hasClass('desejado')){ //quer desejar
            $(this).addClass('desejado');
            quer_desejar('sim',id_produto);
        }else{ //nao quer desejar- desDesejar
            $(this).removeClass('desejado');
            quer_desejar('nao',id_produto);
        }
        
        function quer_desejar(resp,id_produ){
            $.ajax({
                url:'controla_desejos.php',
                type:'post',
                dataType:'html',
                data:{
                    id_prod:id_produ,
                    desejar:resp
                }
            }).done(function(dados){
                console.log(dados);
            })
        }
    })

    // Reconfigurar o formato da data
    $('.data').each(function(ind,ele){
        var data1 = ele.innerText;
        var data2 = data1.split('-');

        var ano = data2[0];
        var mes = data2[1];
        var dia = data2[2];

        ele.innerText = ` ${dia} / ${mes} / ${ano}`;
    })

        $('.qtd').mouseenter(function(){
            var total = $(this).attr('data-total');
            var preco = $(this).next().text();

            $(this).next().text(total);

            $('.qtd').mouseout(function(){
                $(this).next().text(preco);
            })
        })
})