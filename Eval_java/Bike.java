import java.util.Random;

public class Bike extends Vehicule{
    private static Random n = new Random();
    public Bike(String name) {
        super(n.nextInt(5)+1, n.nextInt(5)+1, name);
    }
    public Bike(int Speed, int Adhesion,String name) {
        super(Speed, Adhesion, name);
    }
    
    public String toString(){
        return String.format("This Bike is %s, it has a %d speed value, and it %s with a %d value of adhesion",getStringSpeed(),getSpeed(),getStringAdhesion(),getAdhesion());
    }
}
