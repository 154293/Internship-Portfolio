<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    function isNumeric($a)               //function to check if it's numeric (we had to make it a function for the exercise)
    {
        if (is_numeric($a) != 1) {
            throw new Exception('');
        }
        return true;
    }

    function checkIfZero($b)             //function to check 0
    {
        if ($b == '0') {
            throw new Exception('');
        }
        return true;
    }

    ?>

    <h1>Calculator</h1>

    <form method="post" action="calculator.php">
        <label for="num1">Number 1:</label>
        <input type="text" name="num1" value="<?php echo isset($_POST['num1']) ? $_POST['num1'] : '' ?>">
        <?php

        if (isset($_POST['num1'])) {
            try {
                isNumeric($_POST['num1']);             //checks if the post is a number or not
                $num1 = $_POST['num1'];
            } catch (Exception) {
                echo "Number 1 is not a number!";
            }
        }

        ?>
        <br>
        <label for="num2">Number 2:</label>
        <input type="text" name="num2" value="<?php echo isset($_POST['num2']) ? $_POST['num2'] : '' ?>">
        <?php

        if (isset($_POST['num2'])) {
            try {
                isNumeric($_POST['num2']);           //checks if post is a number
                if (isset($_POST['Divide']) || isset($_POST['Modulo'])) {                   //in the case of division or modulo
                    try {
                        checkIfZero($_POST['num2']);                                        //it checks if it's 0 with a function
                        $num2 = $_POST['num2'];
                    } catch (Exception) {
                        echo "Division by zero is not allowed!";
                    }
                } else {
                    $num2 = $_POST['num2'];
                }
            } catch (Exception) {
                echo "Number 2 is not a number!";
            }
        }

        ?>
        <br>

        <?php

        $operatorArray = array("Add", "Subtract", "Multiply", "Divide", "Modulo");          //array with operators

        foreach ($operatorArray as $operator) {
            if (isset($_POST[$operator])) {
                echo "Operation: " . $operator . '<br>';
                $op = $operator;
            }
        }

        if (isset($num1) && isset($num2)) {         //if both numbers are set, it does the math in the function with the numbers and operator
            doMath($num1, $num2, $op);
        }

        function doMath($num1, $num2, $op)
        {

            switch ($op) {
                case "Add":
                    $result = $num1 + $num2;
                    break;
                case "Subtract":
                    $result = $num1 - $num2;
                    break;
                case "Multiply":
                    $result = $num1 * $num2;         //switch case to switch between operators
                    break;
                case "Divide":
                    $result = $num1 / $num2;
                    break;
                case "Modulo":
                    $result = fmod($num1, $num2);
                    break;
            }

            echo "Result: $result <br>";             //echoes result
        }

        ?>

        <input type="submit" name="Add" value="Add">
        <input type="submit" name="Subtract" value="Subtract">
        <input type="submit" name="Multiply" value="Multiply">
        <input type="submit" name="Divide" value="Divide">                <!-- buttons to pick operator -->
        <input type="submit" name="Modulo" value="Modulo">
    </form>

</body>

</html>