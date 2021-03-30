<?php
function protocol()
{
    /**
     * Faz a verificação se for
     * diferente de https
     */
    if(strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false)
    {
        $protocol = 'http://'; //Atribui o valor http
    }
    else
    {
        $protocol = 'https://'; //Atribui o valor https
    }
    /**
     * Retorna o protocolo em formato string
     * @var string
     */
    return $protocol;
}

function scriptName()
{
    /**
     * $scr
     * Atribui o valor do SCRIPT_NAME em uma
     * variável $scr e utiliza-se a função dirname()
     * para remover qualquer nome de arquivo .html, .php, etc...
     * @var string
     */
    $scr = dirname($_SERVER['SCRIPT_NAME']);
    /**
     * Faz a contagem de barras que contém a url principal
     * o objetivo aqui é pegar o nível de pasta onde hospeda-se o diretório
     * caso ele exista.
     */
    if(!empty($scr) || substr_count($scr, '/') > 1)
    {
        $scriptName = $scr . '/'; //atribui o valor do diretório com uma "/" na sequência
    }
    else
    {
        $scriptName = ''; //atribui um valor vazio
    }
    /**
     * Retorna o scriptName em formato string
     * @var string
     */
    return $scriptName;
}
