Dhont
=====

Implementacion en PHP del sistema D'HONT para repartir bancas electorales. `PHP implementation of D'HONT elective seats distribution`
[Spanish Wiki](https://es.wikipedia.org/wiki/Sistema_D'Hondt)
[English Wiki](http://en.wikipedia.org/wiki/D%27Hondt_method)

Usage:

    $dhont = new Dhont();
    $listas = array(
        'listaA' => 340000,
        'listaB' => 280000,
        'listaC' => 160000,
        'listaD' => 60000,
        'listaE' => 15000,
    );
    $bancas = $dhont->repartirBancas(7, $listas);
    // El ejemplo es el mismo que el que esta en la wiki en espanol.
    die(var_dump($bancas));  
    /**
    array(7) {
      [0]=>
      string(6) "listaA"
      [1]=>
      string(6) "listaB"
      [2]=>
      string(6) "listaA"
      [3]=>
      string(6) "listaC"
      [4]=>
      string(6) "listaB"
      [5]=>
      string(6) "listaA"
      [6]=>
      string(6) "listaB"
    }
    */
