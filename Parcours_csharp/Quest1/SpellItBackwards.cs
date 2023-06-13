namespace CSharpDiscovery.Quest01
{
    public class SpellItBackwards_Exercice
    {
        public static string SpellItBackward(string str)
        {
            return new string(str.ToCharArray().Reverse().ToArray());
        }
    }
}
