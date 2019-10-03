<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<input type="email" class="form-control form-control-user" id="email" id="exampleInputEmail" title="Digite seu E-mail" placeholder="Digite seu E-mail" name="email">

<?php
$res = "<div id='resposta'></div>";
echo $res;
?>


<script language="javascript">
    var email = $("#email");
    email.blur(function() {
        $.ajax({
            url: 'verificaEmail.php',
            type: 'POST',
            data:{"email" : email.val()},
            success: function(data) {
                console.log(data);
                data = $.parseJSON(data);
                $("#resposta").text(data.email);
                // começa o coisa do botão
                var valorDaDiv = $("#resposta").text();  // COOLOCAR TODO FORMULARIO NESSA PAGINA E COLOCAR A VERIFICAÇÃO DE DESABILITAR O BOTAO AQUI NO AJAX OU FORA DO AJAX ({   } )
                console.log(valorDaDiv);
                if(valorDaDiv == 'E-mail já existente'){
                    console.log('Entrou no if');
                    document.getElementById("cadastrar").disabled = true;
                } else {
                    console.log('nao Entrou no if');
                    document.getElementById("cadastrar").disabled = false;
                }
            }
               });
    });
</script>

<div class="form-group row" style="margin-top: 15px">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="password" class="form-control form-control-user" id="exampleInputPassword" title="Digite sua senha" placeholder="Digite sua senha" name="senha">
    </div>
    <div class="col-sm-6">
        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" title="Digite sua senha novamente" placeholder="Verifique a senha" name="senha2">
    </div>
</div>
<input type="submit" class="btn btn-primary btn-user btn-block" id="cadastrar" value="Cadastrar" title="Fazer login" disabled>
