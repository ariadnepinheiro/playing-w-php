/** Deseja-se desenvolver em PHP uma função para atualizar uma matriz de
 * adjacências, considerando a adição de um novo vetor de vértices. Note 
 * que todas as arestas já representadas na matriz de adjacências devem 
 * ser preservadas. Note também que o novo vetor de vértices pode conter
 * arestas para vértices já existentes na matriz original. Esta função deve 
 * utilizar passagem de parâmetro por referência para atualizar a matriz de 
 * adjacências, gerando arestas considerando a mesma probabilidade p. 
 * Note que a implementação das funções deve respeitar as assinaturas
 * abaixo, nas quais o parâmetro $vetorVerticesNovos contém o vetor com os
 * novos vértices, $matriz é a matriz de adjacência atual e $probabilidade 
 * é a mesma probabilidade do item anterior.
*/


<?php

function atualiza_matriz($vetorVerticesNovos, &$matriz, $probabilidade)
{
    $vertices = array_keys($matriz);
    $tamanhoNovo = sizeof($vertices) + sizeof($vetorVerticesNovos);
    for ($i = array_key_last($vertices); $i < $tamanhoNovo; $i++) {
        $vertices[$i] = $i;
    }

    for ($i = 0; $i < $tamanhoNovo; $i++) {
        $verticesRestantes = array_slice($vertices, $i, $tamanhoNovo - $i, true);
        $chave = array_key_first($verticesRestantes);
        $j = $chave;
        foreach ($verticesRestantes as $vertice) {
            $aleatorio = lcg_value();
            if ($j == $chave) {
                $matriz[$i][$j] = 0;
            } elseif ($aleatorio < $probabilidade) {
                $matriz[$i][$j] = 1;
                $matriz[$j][$i] = 1;
            } else {
                $matriz[$i][$j] = 0;
                $matriz[$j][$i] = 0;
            }
            $j++;
        }
    }
    return $matriz;
}
