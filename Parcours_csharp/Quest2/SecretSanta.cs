namespace CSharpDiscovery.Quest02
{
    public class SecretSanta_Exercice
    {
        public static Dictionary<string, string> SecretSantaDraw(HashSet<string> people)
        {
            Dictionary<string, string> Santa = new Dictionary<string, string>();
            Random rnd = new Random();
            for (int i = 0; i < people.Count; i++)
            {
                int nbr = rnd.Next(0, people.Count());

                if (people.ElementAt(i) != people.ElementAt(nbr))
                {
                    Santa.Add(people.ElementAt(i), people.ElementAt(nbr));
                }
                else
                {
                    i--;
                }
            }
            return Santa;
        }
    }
}
