import java.util.*;

public abstract class Character {
    final private int maxHealth;
    protected int currentHealth;
    final private String name;
    private Weapon weapon;
    private static List<Character> allCharacters = new ArrayList<>();

    public int getMaxHealth(){
        return maxHealth;
    }
    public int getCurrentHealth(){
        return currentHealth;
    }
    public String getName(){
        return name;
    }
    public Weapon getWeapon(){
        return weapon;
    }
    public Character(String Name,int MaxHealth,Weapon Weapon){
        name=Name;
        currentHealth=MaxHealth;
        maxHealth=MaxHealth;
        allCharacters.add(this);
        weapon=Weapon;
    }
    public String toString(){
        if (currentHealth==0){
            return String.format("%s : KO", name);
        }
        return String.format("%s : %d/%d", name,currentHealth,maxHealth);
    }
    public abstract void takeDamage(int hit) throws DeadCharacterException;
    public abstract void attack(Character perso) throws DeadCharacterException;
    public static String printStatus(){
        String result = "------------------------------------------\n";
        if (allCharacters.isEmpty()){
            result +="Nobody's fighting right now !\n";
        }else{
            result +="Characters currently fighting :\n";
            for (Character perso :allCharacters){
                result += " - ";
                result += perso.toString();
                result +="\n";
            }
        }
        result +="------------------------------------------";
        return result;
    }
    public static Character fight(Character perso1,Character perso2){
        try{
            while (perso1.getCurrentHealth()>0 && perso2.getCurrentHealth()>0){
                perso1.attack(perso2);
                if (perso2.getCurrentHealth()==0){
                    return perso1;
                }
                perso2.attack(perso1);
            }
            return perso2;
        } catch (DeadCharacterException e){
            e.getMessage();
            return null;
        }

    }
}
