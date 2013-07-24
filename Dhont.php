<?php

/**
 * Implementacion del algoritmo Dhont
 *
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
class Dhont
{
    /**
     * Los divisores de las listas/partidos. Estructura:
     * {identificadorLista1 => 1, identificadorLista2 => 1, ...}
     * 
     * @var array
     */
    private $divisores;
    
    /**
     * Devuelve un array con cantidad de eltos. = a la cantidad de bancas a repartir
     * en cada elto, el valor es igual al valor correspondiente en array $listas.
     * La metodologia para repartir es el sistema DHONT.
     * 
     * @param int   $bancas Cantidad de bancas/escanos.
     * @param array $listas Identificadores de las listas que compiten 
     * por bancas. Estructura {'identificador' => $votosObtenidos}
     * 
     * @return array distribucion de bancas a listas {banca => $lista}
     */
    public function repartirBancas($bancas, $listas)
    {
        asort($listas);
        $listas = array_reverse($listas, true);
        $bancas = $this->_createBancasDivisores($bancas, $listas);
        foreach ($bancas as $key => $b) {
            $max = $this->_getMaxCociente($listas);
            $bancas[$key] = $max['identificador'];
        }
        return $bancas;
    }
    
    /**
     * Devuelve un array de bancas con eltos = false, y cantidad igual a $bancas.
     * y un array de divisores con claves sacadas de las claves de $listas y valores = 1 
     *  
     * @param int   $bancas La cantidad de bancas a repartit.
     * @param array $listas Las listas/partidos que se disputan bancas. Estructura:
     * {identificadorLista1 => $votos1, identificadorLista2 => $votos2, ...}
     * 
     * @return array con estructura [$bancas, $divisores]. en detalle: <pre>
     *    [false, false, ...], // count = $bancas 
     */
    private function _createBancasDivisores($bancas, $listas)
    {
        $bancas = array_fill(0, $bancas, false);
        $this->divisores = array_combine(
            array_keys($listas), 
            array_fill(0, count($listas), 1)
        );
        return $bancas;
    }

    /**
     * Usa los divisores, en el estado en que se encuentren para encontrar el mayor 
     * cociente, incrementa en 1 el divisor del mayor cociente. Esto reduce las 
     * chances de vovler a elegir el mismo partido/lista la proxima vez.
     * 
     * @param array $listas Las listas/partidos que se disputan bancas. Estructura:
     * {identificadorLista1 => $votos1, identificadorLista2 => $votos2, ...}
     * 
     * @return array Estructutra {'identificador' => $lista, 'cociente' => $maxCociente}
     */
    private function _getMaxCociente($listas)
    {
        $max = array('identificador' => null, 'cociente' => -1);
        foreach ($listas as $identificador => $votos) {
            $cociente = $votos / $this->divisores[$identificador];
            if ($max['cociente'] < $cociente) {
                // si algun max cociente empata con otro, prevalece el de la lista 
                // con mas votos. Si tambien empatan en votos (chocan con divisor 1), se jode la 2da.
                $max = array('identificador' => $identificador, 'cociente' => $cociente);
            }
        }
        $this->divisores[$max['identificador']]++;
        return $max;
    }
}
