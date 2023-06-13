using System;

namespace CSharpDiscovery.Examen
{
    public class Cleric : Character, IHealer
    {
        public int HealPower { get; set; }
        public float Mana { get; set; }

        public Cleric() : base()
        {
            Mana = 100;
            HealPower = 15;
        }

        public Cleric(string name, float maxhealth) : base(name, maxhealth)
        {
            Mana = 100;
            HealPower = 15;
        }

        public void DownMana(int mana)
        {
            if (Mana - mana < 0)
            {
                Mana = 0;
            }
            else
            {
                Mana -= mana;
            }
        }

        public override void Special()
        {
            if (Mana + 10 > 100)
            {
                Mana = 100;
            }
            else
            {
                Mana += 10;
            }
        }

        public override void CibledSpecial(Character cible)
        {
            if (Mana > 10)
            {
                DownMana(10);
                if (cible.Health + HealPower > cible.MaxHealth)
                {
                    cible.Health = cible.MaxHealth;
                }
                else
                {
                    cible.Health += HealPower;
                }
            }
            else
            {
                Console.WriteLine("Mana is to Low for using CibledSpecial.");
            }
        }

        public void DoubleHeal(Character cible1, Character cible2)
        {
            if (Mana > 10)
            {
                if (cible1.Health + HealPower / 2 > cible1.MaxHealth)
                {
                    cible1.Health = cible1.MaxHealth;
                }
                else
                {
                    cible1.Health += HealPower;
                }
                if (cible2.Health + HealPower / 2 > cible2.MaxHealth)
                {
                    cible2.Health = cible2.MaxHealth;
                }
                else
                {
                    cible2.Health += HealPower;
                }
                DownMana(10);
            }
            else
            {
                Console.WriteLine("Mana is to Low for using DoubleHeal.");
            }
        }

        public int GetHeal()
        {
            return HealPower;
        }

        public override string ToString()
        {
            return string.Format(
                "{0} : {1}/{2} | Classe : Clerc | Mana : {3}",
                Name,
                Health,
                MaxHealth,
                Mana
            );
        }
    }
}
