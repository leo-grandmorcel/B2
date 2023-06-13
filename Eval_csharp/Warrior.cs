using System;

namespace CSharpDiscovery.Examen
{
    public class Warrior : Character, ITank
    {
        public int AttackPower { get; set; }
        public bool Bravery { get; set; }

        public Warrior() : base()
        {
            Bravery = false;
            AttackPower = 25;
        }

        public Warrior(string name, float maxhealth) : base(name, maxhealth)
        {
            Bravery = false;
            AttackPower = 25;
        }

        public override void Special()
        {
            if (Health < 30)
            {
                Bravery = true;
            }
        }

        public override void CibledSpecial(Character cible)
        {
            if (Bravery)
            {
                cible.TakeDamage(AttackPower + 15);
            }
            else
            {
                cible.TakeDamage(AttackPower);
            }
        }

        public void DoubleHit(Character cible)
        {
            TakeDamage(10);
            cible.TakeDamage(AttackPower * 2);
        }

        public int GetPower()
        {
            return AttackPower;
        }

        public override string ToString()
        {
            return string.Format(
                "{0} : {1}/{2} | Classe : Guerrier | Bravoure : {3}",
                Name,
                Health,
                MaxHealth,
                Bravery
            );
        }
    }
}
