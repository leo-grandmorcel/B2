namespace CSharpDiscovery.Quest02
{
    public class FindLastIndex_Exercice
    {
        public static int? FindLastIndex(int[] tab, int a)
        {
            // Your code
            return tab != null && tab.Contains(a) ? Array.LastIndexOf(tab, a) : null;
        }
    }
}
