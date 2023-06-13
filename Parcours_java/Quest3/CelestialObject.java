package Quest3;
import java.util.Objects;


public class CelestialObject {
    public static double KM_IN_ONE_AU = 150000000;
    private double x;
    private double y;
    private double z;
    private String name;
    private int mass;
    public CelestialObject(){
        x=0.0;
        y=0.0;
        z=0.0;
        name="Soleil";
        mass=0;
    }

    public CelestialObject(String Name,double ex,double ey, double ez,int Mass){
        name=Name;
        x=ex;
        y=ey;
        z=ez;
        mass=Mass;
    }

    public double getX(){
        return x;
    }
    public double getY(){
        return y;
    }
    public double getZ(){
        return z;
    }
    public String getName(){
        return name;
    }
    public int getMass(){
        return mass;
    }
    public void setMass(int Mass){
        mass=Mass;
    }
    public void setX(double ex){
        x=ex;
    }
    public void setY(double ey){
        y=ey;
    }
    public void setZ(double ez){
        z=ez;
    }
    public void setName(String Name){
        name=Name;
    }

    public static double getDistanceBetween(CelestialObject obj1, CelestialObject obj2){
        return Math.sqrt(Math.pow(obj1.x-obj2.x,2)+Math.pow(obj1.y-obj2.y,2)+Math.pow(obj1.z-obj2.z,2));
    }

    public static double getDistanceBetweenInKm(CelestialObject obj1, CelestialObject obj2){
        return getDistanceBetween(obj1, obj2)*KM_IN_ONE_AU;
    }
    public String toString(){
        return String.format("%s is positioned at (%.3f, %.3f, %.3f)",name,x,y,z);
    }
    public boolean equals(Object object){
        if (object instanceof CelestialObject){
            CelestialObject obj1 = (CelestialObject) object;
            return (obj1.x==this.x && obj1.y==this.y && obj1.z==this.z && obj1.name.equals(this.name));
        }
        return false;
    }
    public int hashCode(){
        return Objects.hash(name,x,y,z,mass);
    }
}
