package Quest3;
import java.util.Objects;

public class Star extends CelestialObject{
    private double magnitude;
    public double getMagnitude(){
        return magnitude;
    }
    public void setMagnitude(double Magn){
        magnitude = Magn;
    }
    public Star(){
        super();
        magnitude=0.0;
    }
    public Star(String Name, double ex, double ey, double ez, double Magn,int mass){
        super(Name, ex, ey, ez,mass);
        setMagnitude(Magn);
    }
    public boolean equals(Object object){
        if (object instanceof Star){
            Star obj1 = (Star) object;
            return super.equals(obj1) && obj1.magnitude == this.magnitude;
        }
        return false;
    }
    public int hashCode(){
        return Objects.hash(super.hashCode(),magnitude);
    }
    public String toString(){
        return String.format("%s shines at the %.3f magnitude", getName(),magnitude);
    }
}
