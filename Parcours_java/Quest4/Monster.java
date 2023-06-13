public class Monster extends Character{
    public Monster(String name,int Pv,Weapon Wep){
        super(name, Pv,Wep);
    }
    public String toString(){
        String result;
        if (getCurrentHealth()>0){
            result = String.format("%s is a monster with %d HP", getName(), getCurrentHealth());
        }else{
            result = String.format("%s is a monster and is dead", getName());
        }
        if (getWeapon() !=null){
            result += String.format(" He has the weapon %s",getWeapon().toString());
        }
        return result;
    }
    public void takeDamage(int hit) throws DeadCharacterException{
        if (currentHealth==0){
            throw new DeadCharacterException(this);
        }
        double damage = Math.floor(hit*0.80);
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
        if (getWeapon() == null){
            perso.takeDamage(7);
        }else{
            perso.takeDamage(getWeapon().getDamage());
        }
    }
}
