package Quest3;
import java.util.Objects;

public class Planet extends CelestialObject{
    private Star centerStar;
    public Planet(){
        super();
        centerStar=new Star();
    }
    public Planet(String Name,double ex,double ey,double ez,Star star,int mass){
        super(Name, ex, ey, ez,mass);
        centerStar= new Star(star.getName(),star.getX(),star.getY(),star.getZ(),star.getMagnitude(),mass);
    }
    public Star getCenterStar(){
        return centerStar;
    }
    public void setCenterStar(Star star){
        centerStar = star;
    }
    public int hashCode(){
        return Objects.hash(super.hashCode(),centerStar);
    }
    public boolean equals(Object object){
        if (object instanceof Planet){
            Planet obj1 = (Planet) object;
            return super.equals(obj1) && obj1.centerStar.equals(this.getCenterStar());
        }
        return false;
    }
    public String toString(){ 
        return String.format("%s circles around %s at the %.3f AU", getName(),centerStar.getName(),CelestialObject.getDistanceBetween(centerStar, this));
    }
}
