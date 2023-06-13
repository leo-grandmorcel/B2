namespace CSharpDiscovery.Quest01
{
    public class DoubleArrayForEvenInteger_Exercice
    {
        public static int[] DoubleArrayForEvenInteger(int[] inputTab)
        {
            return inputTab.Select(x => x % 2 != 0 ? x * 2 : x).ToArray();
        }
    }
}
