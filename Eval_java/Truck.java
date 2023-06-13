import java.util.Random;

public class Truck extends Vehicule {
    private static Random n = new Random();
    public Truck(String name) {
        super(n.nextInt(5) + 1, n.nextInt(6) + 5, name);
    }
    public Truck(int Speed, int Adhesion, String name) {
        super(Speed, Adhesion, name);
    }
    public String toString(){
        return String.format("This TRUCK is %s, it has a %d speed value, and it %s with a %d value of adhesion",getStringSpeed(),getSpeed(),getStringAdhesion(),getAdhesion());
    }
}
