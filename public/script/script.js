// só para relembrar, para o jquery funcionar, basta adicionálo acima na página html
$(document).ready(()=>{
    $('#chat-click').on('click', e=>{
        $('#chatBox').removeClass('display')
        $('#chat-click').addClass('display')
    })
    $('#sair').on('click', e=>{
        $('#chatBox').addClass('display')
        $('#chat-click').removeClass('display')
    })
    function clicavel(elemento){
        $(elemento).css('cursor', 'pointer');
    }
    $('#card1').hover(()=>{
        $('#card1').fadeTo(500, 1)
    },()=>{
        $('#card1').fadeTo(500,0.5)
    })
    $('#card2').hover(()=>{
        $('#card2').fadeTo(500, 1)
    },()=>{
        $('#card2').fadeTo(500,0.5)
    })
    $('#card3').hover(()=>{
        $('#card3').fadeTo(500, 1)
    },()=>{
        $('#card3').fadeTo(500,0.5)
    })  
})