<?php
//LISTA SERVIÇOS ATIVOS
if (isset($userServices)) :
    for ($i = 0; $i < sizeof($userServices); $i++) :
        if ($userServices[$i]->situacao == 1) :
            switch ($userServices[$i]->idServico):
                case 1: ?>
                    <p>Biometria <input type='checkbox' checked='checked' disabled></p>
                <?php
                    break;

                case 2: ?>
                    <p>Análise de Riscos <input type='checkbox' name='analiseRiscos' value='AnaliseRiscos' checked='checked' disabled></p>
                <?php
                    break;

                case 3: ?>
                    <p>Workshop <input type='checkbox' name='workshop' value='workshop' checked='checked' disabled></p>
                <?php
                    break;

                case 4: ?>
                    <p>Serviços de Segurança <input type="checkbox" name="servicoSeguranca" value="seguranca" checked="checked" disabled></p>
                <?php
                    break;
            endswitch;
        endif;
    endfor;

else : ?>
    <p>Não foram encontrados serviços ativos</p>
<?php endif;
