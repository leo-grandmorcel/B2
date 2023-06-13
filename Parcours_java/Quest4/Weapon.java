public class Weapon {
    final private String name;
    final private int damage;
    public Weapon(String Name, int Damage){
        name=Name;
        damage=Damage;
    }
    public String getName(){
        return name;
    }
    public int getDamage(){
        return damage;
    }
    public String toString(){
        return String.format("%s deals %d damages",getName(),getDamage());
    }
}
