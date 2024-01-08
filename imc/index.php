<div>
    <p> O seu IMC está
        <b>
            <?php

            $peso = 80;
            $altura = 1.83;

            $imc = $peso / ($altura ** 2);

            if ($imc < 18.5) {
                echo 'magreza';
            } elseif ($imc >= 18.5 && $imc <= 24.9) {
                echo 'normal';
            } elseif ($imc >= 25 && $imc <= 29.9) {
                echo 'sobrepeso';
            } elseif ($imc >= 30 && $imc <= 39.9) {
                echo 'obesidade';
            } else {
                echo 'obesidade grave';
            }
            ?>

        </b>
    </p>
</div>

<div>
    <p>
        A temperatura em Fahrenheit é: 
        <?php
        
        $celsius = 10;
        $fahrenheit = ($celsius * 1.8) + 32; 

        echo $fahrenheit;

        ?>
    </p>
</div>