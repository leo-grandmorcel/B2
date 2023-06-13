namespace CSharpDiscovery.Examen
{
    public interface IHealer
    {
        public int HealPower { get; set; }
        public void DoubleHeal(Character cible1, Character cible2);
        public int GetHeal();
    }

    public interface ITank
    {
        public int AttackPower { get; set; }
        public void DoubleHit(Character cible);
        public int GetPower();
    }
}
