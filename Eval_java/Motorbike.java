import java.util.Random;

public class Motorbike extends Vehicule{
    private static Random n = new Random();
    public Motorbike(String name) {
        super(n.nextInt(6) + 5,n.nextInt(5 )+ 1, name);
    }
    public Motorbike(int Speed, int Adhesion, String name) {
        super(Speed, Adhesion, name);
    }
    public String toString(){
        return String.format("This MOTORBIKE is %s, it has a %d speed value, and  it %s with a %d value of adhesion",getStringSpeed(),getSpeed(),getStringAdhesion(),getAdhesion());
    }
}
