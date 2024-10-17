float getal_1 = 0f;
float getal_2 = 0f;
string input1, input2;
float resultaat = 0;
bool isnumeric;
Console.WriteLine("Operatie?");
string operatie = Console.ReadLine();
if (operatie == "+" || operatie == "-" || operatie == "*" || operatie == "/" || operatie == "%")
{
    Console.WriteLine("Eerste getal?");
    input1 = Console.ReadLine();
    try
    {
        getal_1 = float.Parse(input1);
    }
    catch (Exception e)
    {
        Console.WriteLine("Dat is geen geldig nummer");
        Environment.Exit(0);
    }
    Console.WriteLine("Tweede Getal?");
    input2 = Console.ReadLine();
    try
    {
        getal_2 = float.Parse(input2);
    }
    catch (Exception e)
    {
        Console.WriteLine("Dat is geen geldig nummer");
        Environment.Exit(0);
    }
    if (operatie == "+")
    {
        resultaat = getal_1 + getal_2;
        Console.WriteLine("Resultaat:");
        Console.WriteLine(resultaat);
    }
    else if (operatie == "-")
    {
        resultaat = getal_1 - getal_2;
        Console.WriteLine("Resultaat:");
        Console.WriteLine(resultaat);
    }
    else if (operatie == "*")
    {
        resultaat = getal_1 * getal_2;
        Console.WriteLine("Resultaat:");
        Console.WriteLine(resultaat);
    }
    else if (operatie == "/")
    {
        if (getal_2 != 0)
        {
            resultaat = getal_1 / getal_2;
            Console.WriteLine("Resultaat:");
            Console.WriteLine(resultaat);
        }
        else
        {
            Console.WriteLine("Kan niet delen door 0");
        }
    }
    else if (operatie == "%")
    {
        if (getal_2 != 0)
        {
            resultaat = getal_1 % getal_2;
            Console.WriteLine("Resultaat:");
            Console.WriteLine(resultaat);
        }
        else
        {
            Console.WriteLine("Kan niet delen door 0");
        }
    }
}
else
{
    Console.WriteLine(operatie + " is geen geldige operatie");
}