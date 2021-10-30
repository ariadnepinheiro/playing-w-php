/** Deseja-se desenvolver em PHP uma função para desenvolver grafos cujas arestas
 * entre os vértices possuem uma probabilidade p de existir (grafo conhecido pelo
 * nome de Erdõs-Rényi, G(n,p)), onde n é o número de vértices. Esta função deve 
 * retornar a matriz de adjacências correspondente. Note que a implementação das 
 * funções deve respeitar as assinaturas abaixo, na qual o parâmetro $vetorVertices
 * contém o vetor de vértices (p.ex., o vetor V da figura acima) e o parâmetro 
 * $probabilidade é um número real entre 0 e 1 usado para definir se cada uma das 
 * arestas entre os elementos de V existem ou não.
 * 
 * Dica: A implementação da função deve considerar cada uma das possíveis arestas do
 * grafo através da combinação dois a dois de todos os vértices. A aresta existe se 
 * o valor retornado por uma função aleatória for menor que o valor da probabilidade 
 * utilizada. A função aleatória deve retornar valores pertencentes ao mesmo intervalo
 * real de probabilidades, ou seja, entre 0 e 1.
*/


<?php

function cria_grafo($vetorVertices, $probabilidade)
{
    $tamanho = sizeof($vetorVertices);
    $grafo = array_fill(0, $tamanho, array_fill(0, $tamanho, 0));

    for ($i = 0; $i < $tamanho; $i++) {
        $verticesRestantes = array_slice($vetorVertices, $i, $tamanho - $i, true);
        $chave = array_key_first($verticesRestantes);
        $j = $chave;
        foreach ($verticesRestantes as $vertice) {
            $aleatorio = lcg_value();
            if ($j == $chave) {
                $grafo[$i][$j] = 0;
            } elseif ($aleatorio < $probabilidade) {
                $grafo[$i][$j] = 1;
                $grafo[$j][$i] = 1;
            }
            $j++;
        }
    }
    return $grafo;
}
