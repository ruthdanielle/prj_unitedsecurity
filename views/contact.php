<?php
    //chamada de cabeçalho
    require_once "include/header.php";
?>

<section id="SectionContato">
    
    <H1 class="titulo">CONTATO</H1>
       
        <?php
        if (isset($data['contactalert'])):
            $alert = base64_decode($data['contactalert']);
            if ($alert == 'sucesso'):?>

                <h3>Mensagem enviada com sucesso!</h3>
            <?php endif;
        
        endif;
        ?>

    <form id="contato" action="<?= url("contato") ?>" method="POST">

        <fieldset class="contatos">
        
            <h3>Preencha o formulário para falar conosco</h3><br>

            <div>
            <label for="nome">Nome<b>*</b>:</label>
            <input type="text" id="nome" name="name" placeholder="Digite seu nome completo" required/>
     
            <label for="telefone">Telefone<b>*</b>:</label>
            <input type="tel" id="telefone" name="tel" placeholder="Somente Numeros" required/><br>

            <label for="emailcon">E-mail<b>*</b>:</label>
            <input type="email" id="emailcon" name="emailcon" placeholder="Informe seu e-mail" required/>
            
            <label for="subject">Assunto<b>*</b>:</label>
            <select name="subject" id="subject">
                <option disabled selected='true'>Selecione o assunto...</option>
                <option value="Contratar Serviços">Contratar serviços</option>
                <option value="Duvida sobre produtos">Duvida sobre produtos</option>
                <option value="Sugestão de melhoria">Sugestão de melhoria</option>
                <option value="Outros">Outros</option>
            </select>
     
            <label for="mensagem">Mensagem<b>*</b>:</label>
            <br><textarea id="mensagem" name="mensagem" style="resize:none"></textarea>
        
            </div>
                
            <br>
            <input type="submit" value="Enviar" id="enviar" name="contato">
                      
        </fieldset>


        
    </form>


</section>



<?php
    //chamada de rodapé
    require_once "include/footer.php";
?>
