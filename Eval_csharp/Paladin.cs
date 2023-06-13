using System;

namespace CSharpDiscovery.Examen
{
    public class Paladin : Character, IHealer, ITank
    {
        public int HealPower { get; set; }
        public int AttackPower { get; set; }
        public int Buff { get; set; }

        public Paladin() : base()
        {
            Buff = 0;
            // Je me suis permis de réduire les valeurs pour le paladin
            HealPower = 5;
            AttackPower = 10;
        }

        public Paladin(string name, float maxhealth) : base(name, maxhealth)
        {
            Buff = 0;
            // Je me suis permis de réduire les valeurs pour le paladin
            HealPower = 5;
            AttackPower = 10;
        }

        public override void Special()
        {
            if (Health + HealPower + Buff > MaxHealth)
            {
                Health = MaxHealth;
            }
            else
            {
                Health += HealPower + Buff;
            }
        }

        public override void CibledSpecial(Character cible)
        {
            cible.TakeDamage(AttackPower + Buff);
            if (Buff + 3 > 15)
            {
                Buff = 15;
            }
            else
            {
                Buff += 3;
            }
        }

        public void DoubleHit(Character cible)
        {
            TakeDamage(20);
            cible.TakeDamage(AttackPower * 2);
        }

        public int GetPower()
        {
            return AttackPower;
        }

        public int GetHeal()
        {
            return HealPower;
        }

        public void DoubleHeal(Character cible1, Character cible2)
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
        }

        public override string ToString()
        {
            return string.Format(
                "{0} : {1}/{2} | Classe : Paladin | Buff : {3}",
                Name,
                Health,
                MaxHealth,
                Buff
            );
        }
    }
}
