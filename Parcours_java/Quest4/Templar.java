public class Templar extends Character implements Healer,Tank{
    private final int healCapacity;
    private final int shield;

    public Templar(String Name, int MaxHealth,int PV,int blue,Weapon Wep) {
        super(Name, MaxHealth,Wep);
        healCapacity=PV;
        shield=blue;
    }

    public int getShield() {
        return shield;
    }

    public int getHealCapacity() {
        return healCapacity;
    }

    public void heal(Character perso) throws DeadCharacterException {
        if (currentHealth==0){
            throw new DeadCharacterException(this);
        }
        if (perso.getCurrentHealth()+healCapacity<perso.getMaxHealth()){
            perso.currentHealth+=healCapacity;
        }else{
            perso.currentHealth=perso.getMaxHealth();
        }
    }
    public String toString(){
        String result;
        if (getCurrentHealth()>0){
            result = String.format("%s is a strong Templar with %d HP. It can heal %d HP and has a shield of %d.", getName(),getCurrentHealth(),getHealCapacity(),shield);
        }else{
            result = String.format("%s has been beaten, even with its %d shield. So bad, it could heal %d HP.",getName(),shield,getHealCapacity());
        }
        if (getWeapon() !=null){
            result += String.format(" He has the weapon %s",getWeapon().toString());
        }
        return result;
    }
    public void takeDamage(int hit) throws DeadCharacterException {
        double damage = hit-shield;
        if (currentHealth==0){
            throw new DeadCharacterException(this);
        }
        if (currentHealth-damage>0){
            currentHealth-=damage;
        }else{
            currentHealth=0;
        }
        
    }
    public void attack(Character perso) throws DeadCharacterException {
        if (currentHealth==0){
            throw new DeadCharacterException(this);
        }
        heal(this);
        if (getWeapon() ==null){
            perso.takeDamage(6);
        }else{
            perso.takeDamage(getWeapon().getDamage());
        }
    }
}
