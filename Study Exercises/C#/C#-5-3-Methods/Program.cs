int[] results;
results = Calculations.Resultaten(5);
Console.WriteLine($"Volume = {results[0]} en oppervlakte = {results[1]}");

results = Calculations.Resultaten(10);
Console.WriteLine($"Volume = {results[0]} en oppervlakte = {results[1]}");

results = Calculations.Resultaten(20);
Console.WriteLine($"Volume = {results[0]} en oppervlakte = {results[1]}");
class Calculations
{
    public static int VolumeKubus(int lengte)
    {
        return lengte * lengte * lengte;
    }

    public static int OppKubus(int lengte)
    {
        return 6 * lengte * lengte;
    }

    public static int[] Resultaten(int lengte)
    {
        int volRes = Calculations.VolumeKubus(lengte);
        int oppRes = Calculations.OppKubus(lengte);

        return new[] { volRes, oppRes };
    }
}
