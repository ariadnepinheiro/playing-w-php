/** 
 * A função esconde_senha($texto) deve esconder a senha, de tamanho 
 * arbitrário e escrita em claro, em uma string de mesmo tamanho, 
 * mas composta apenas por asteriscos. Para isso, a função DEVE seguir 
 * as seguintes etapas: receber uma string, encontrar por meio de 
 * expressão regular o rótulo "senha:", ignorando espaços intermediários
 * (“senha: ” ou “senha:”), substituir a sequência de caracteres que 
 * aparece em seguida por * e retornar a string produzida.
 */


<?php
function esconde_senha($texto) {
    $posit = strpos($texto, 'senha:');
    $blankSpace = 0;

    for ($k = 5; $k <= strlen($texto) - ($posit + 1); $k++) {
        if(intval($texto[$posit + $k])) {
            $texto[$posit + $k] = '*';
            $blankSpace = 1;
        } elseif($texto[$posit + $k] == ' ' && $blankSpace == 1) {
            break;
        } elseif($texto[$posit + $k] == '.' ||
            $texto[$posit + $k] == ',' ||
            $texto[$posit + $k] == '!' ||
            $texto[$posit + $k] == '?') {
            break;
        }
    }
    return $texto;

}

$texto = "Esta conta tem senha: 12345.";
echo esconde_senha($texto);
?>
