import java.util.Random;

public class Kart extends Vehicule {
    private static Random n = new Random();
    public Kart(String name) {
        super(n.nextInt(6)+5,n.nextInt(6)+5, name);
    }
    public Kart(int Speed, int Adhesion, String name) {
        super(Speed, Adhesion, name);
    }

    public String toString(){
        return String.format("This KART is %s, it has a %d speed value, and it %s with a %d value of adhesion",getStringSpeed(),getSpeed(),getStringAdhesion(),getAdhesion());
    }
}
