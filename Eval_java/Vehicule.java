import java.util.Random;

public abstract class Vehicule{
    private int DistanceTraveled;
    private int Speed;
    private int Adhesion;
    private int Out;
    private String PilotName;
    private boolean End;

    public Vehicule(int speed, int adhesion, String name){
        Speed = speed;
        Adhesion = adhesion;
        PilotName = name;
        Out = 0;
        End = false;
    }

    public int getDistanceTraveled(){
        return DistanceTraveled;
    }
    public void setDistanceTraveled(int distance){
        DistanceTraveled = distance;
    }
    public int getSpeed(){
        return Speed;
    }
    public int getAdhesion(){
        return Adhesion;
    }
    public int getOut(){
        return Out;
    }
    public void setOut(int out){
        Out = out;
    }
    public String getPilotName(){
        return PilotName;
    }
    public boolean getEnd(){
        return End;
    }
    public void setEnd(boolean end){
        End = end;
    }

    public void Forward(){
        Accident();
        if (Out<=0){
            DistanceTraveled += Speed * (11-Adhesion);
        }
    }
    public void Accident(){
        if (Out > 0){
            Out -= 1;
        }else{
            int n = new Random().nextInt(10)+1;
            if (n > Adhesion){
                setOut(5);
            }
        }
    }
    public String getStringSpeed(){
        int Value = getSpeed();
        if (Value >= 1 & Value <=2){
            return "slow";
        }else if (Value >= 3 & Value <=4){
            return  "rather slow";
        }else if (Value >= 5 & Value <=6){
            return "rather fast";
        }else if (Value >=7 & Value<=8){
            return "fast";
        }else {
            return "very fast";
        }
    }
    public String getStringAdhesion(){
        int Value = getAdhesion();
        if (Value >= 1 & Value <=2){
            return "barely sticks to the ground";
        }else if (Value >= 3 & Value <=4){
            return  "sticks to the ground";
        }else if (Value >= 5 & Value <=6){
            return "grips the ground quite well";
        }else if (Value >=7 & Value<=8){
            return "adheres well to the ground";
        }else {
            return "adheres perfectly";
        }
    }
}