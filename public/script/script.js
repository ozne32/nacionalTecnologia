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
    $('#nmrTel').inputmask('+99 (99)99999-9999')
    //efeito nos cards de planos
    for(let i = 1; i<=3; i++){
        $(`#card${i}`).hover(()=>{
            $(`#card${i}`).fadeTo(500, 1)
        },()=>{
            $(`#card${i}`).fadeTo(500,0.5)
        })
    }  
    $('#click-abaixar').on('click', ()=>{
        $('#limite').slideToggle()
    })
    $('input').on('focus', e=>{
        $(e.target).addClass('bordaInput')
    })
    $('input').on('blur', e=>{
        $(e.target).removeClass('bordaInput')
    })
    $('textarea').on('focus', e=>{
        $(e.target).addClass('bordaInput')
    })
    $('textarea').on('blur', e=>{
        $(e.target).removeClass('bordaInput')
    })
})