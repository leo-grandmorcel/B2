using System;

namespace CSharpDiscovery.Examen
{
    public abstract class Character
    {
        public string Name { get; set; }
        public float Health { get; set; }
        public float MaxHealth { get; set; }
        public DateTime CreationDate { get; set; }

        public Character()
        {
            Name = "NPC";
            Health = 100;
            MaxHealth = 100;
            CreationDate = DateTime.Now;
        }

        public Character(string name, float maxhealth)
        {
            Name = name;
            MaxHealth = maxhealth;
            Health = maxhealth;
            CreationDate = DateTime.Now;
        }

        public void TakeDamage(int damage)
        {
            if (Health - damage < 0)
            {
                Health = 0;
            }
            else
            {
                Health -= damage;
            }
        }

        public string GetCreationDate()
        {
            return CreationDate.ToString("dd/MM HH:mm");
        }

        public override string ToString()
        {
            return string.Format("{0} : {1}/{2}", Name, Health, MaxHealth);
        }

        public abstract void Special();

        public abstract void CibledSpecial(Character cible);
    }
}
