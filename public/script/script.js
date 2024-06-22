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
})