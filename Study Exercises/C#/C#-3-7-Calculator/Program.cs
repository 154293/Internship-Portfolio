float getal1 = 0f;
float getal2 = 0f;
float resultaat = 0f;
string input1, input2;
Console.WriteLine("Operatie?");          //asks user for operator
string operatie = Console.ReadLine();
if (operatie == "+" || operatie == "-" || operatie == "*" || operatie == "/" || operatie == "%")    //array with valid operators
{
    static float CheckNumber(string input)
    {
        try
        {
            return float.Parse(input);                   //checknumber method tries making input into float
        }
        catch (Exception e)
        {
            Console.WriteLine(input + " is geen geldig getal!");   //otherwise, it quits the application
            Environment.Exit(0);
        }
        return 0f;
    }

    Console.WriteLine("Eerste getal?");
    input1 = Console.ReadLine();                //both inputs get ran through the method
    getal1 = CheckNumber(input1);

    Console.WriteLine("Tweede Getal?");
    input2 = Console.ReadLine();
    getal2 = CheckNumber(input2);

    if (operatie == "+" || operatie == "-" || operatie == "*")
    {
        switch (operatie)
        {
            case "+":
                resultaat = getal1 + getal2;
                break;
            case "-":
                resultaat = getal1 - getal2;          //switch case for the basic operators
                break;
            case "*":
                resultaat = getal1 * getal2;
                break;
        }
        string output = resultaat.ToString("0.############");    //my attempt at making the float output work (it didn't)
        Console.WriteLine("Resultaat: " + output);
    }
    else if (operatie == "/" || operatie == "%")
    {
        if (getal2 != 0)                     //for the other operators, there's an extra check to see if the second number is 0
        {
            switch (operatie)
            {
                case "/":
                    resultaat = getal1 / getal2;        
                    break;
                case "%":
                    resultaat = getal1 % getal2;
                    break;
            }
            Console.WriteLine("Resultaat: " + resultaat);
        }
        else
        {                                                       //if it is a 0, it can't be used in division
            Console.WriteLine("Kan niet delen door 0");
        }
    }
}
else
{                                                                  //if it's none of the mentioned operators, it can't be used
    Console.WriteLine(operatie + " is geen geldige operatie");
}