public class Sorcerer extends Character implements Healer {
    private final int healCapacity;
    public Sorcerer(String Name, int MaxHealth, int Cap,Weapon Wep) {
        super(Name, MaxHealth,Wep);
        healCapacity=Cap;
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

    public int getHealCapacity(){
        return healCapacity;
    }

    public String toString(){
        String result;
        if (getCurrentHealth()>0){
            result = String.format("%s is a sorcerer with %d HP. It can heal %d HP.", getName(), getCurrentHealth(),getHealCapacity());
        }else{
            result = String.format("%s is a dead sorcerer. So bad, it could heal %d HP.", getName(), getHealCapacity());
        }
        if (getWeapon() !=null){
            result += String.format(" He has the weapon %s",getWeapon().toString());
        }
        return result;
    }
    public void takeDamage(int hit) throws DeadCharacterException {
        if (currentHealth==0){
            throw new DeadCharacterException(this);
        }
        if (currentHealth-hit>0){
            currentHealth-=hit;
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
            perso.takeDamage(10);
        }else{
            perso.takeDamage(getWeapon().getDamage());
        }
    }
}
