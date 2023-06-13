using CSharpDiscovery.Examen;

namespace TestCSharp
{
    class Program
    {
        static void Main(string[] str)
        {
            var RdWarrior = new Warrior();
            var Warrior1 = new Warrior("Leo", 150);
            var RdCleric = new Cleric();
            var Cleric1 = new Cleric("Paul", 150);
            var RdPaladin = new Paladin();
            var Paladin1 = new Paladin("Audren", 150);
            Console.WriteLine(RdWarrior.ToString());
            Console.WriteLine(RdWarrior.GetCreationDate());
            Console.WriteLine(Warrior1.ToString());
            Console.WriteLine(RdCleric.ToString());
            Console.WriteLine(Cleric1.ToString());
            Console.WriteLine(RdPaladin.ToString());
            Console.WriteLine(Paladin1.ToString());
            Console.WriteLine("-----TOUR------");
            Warrior1.CibledSpecial(RdWarrior);
            Warrior1.DoubleHit(RdCleric);
            Paladin1.DoubleHit(RdPaladin);
            Console.WriteLine(RdWarrior.ToString());
            Console.WriteLine(Warrior1.ToString());
            Console.WriteLine(RdCleric.ToString());
            Console.WriteLine(Cleric1.ToString());
            Console.WriteLine(RdPaladin.ToString());
            Console.WriteLine(Paladin1.ToString());
            Console.WriteLine("-----TOUR------");
            Cleric1.DoubleHeal(RdWarrior, RdCleric);
            Console.WriteLine(Cleric1.ToString());
        }
    }
}
