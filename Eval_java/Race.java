import java.util.ArrayList;
import java.util.List;
import java.util.Random;

public class Race {
    public int MinVehicle;
    public int MaxVehicle;
    public List<Vehicule> AllVehicles;
    public List<Viewer> AllViewers;

    public Race(){
        MinVehicle = 0;
        MaxVehicle = 0;
        AllVehicles = new ArrayList<Vehicule>();
        AllViewers = new ArrayList<Viewer>();
    }
    public Race(int minVehicle, int maxVehicle){
        MinVehicle = minVehicle;
        MaxVehicle = maxVehicle;
        AllVehicles = new ArrayList<Vehicule>();
        AllViewers = new ArrayList<Viewer>();
    }
    public void AddVehicle(Vehicule veh){
        if (AllVehicles.size()+1 > MaxVehicle){
            System.out.println("Already MaxVehicle on this race");
        }else{
            AllVehicles.add(veh);
        }
    }
    public void AddViewer(Viewer view){
        AllViewers.add(view);
    }
    public Vehicule[] StartRace(){
        if (AllVehicles.size() < MinVehicle){
            System.out.println(String.format("Not enough vehicle in the race, need %d more to start.",MinVehicle - AllVehicles.size()));
        }
        int Nbrtours = new Random().nextInt(901)+100;
        List<Vehicule> Finish = new ArrayList<Vehicule>();
        System.out.println(String.format("The race starts with %d vehicles for %d laps.\nThere are %d viewers",AllVehicles.size(),Nbrtours,AllViewers.size()));
        while (AllVehicles.size()>Finish.size()){
            for (Vehicule veh : AllVehicles){
                if (veh.getEnd()){
                    continue;
                }else{
                    veh.Forward();
                    if (veh.getDistanceTraveled()>=Nbrtours){
                        veh.setEnd(true);
                        Finish.add(veh);
                        System.out.println(String.format(" - %s just crossed the finish line",veh.getPilotName()));
                        continue;
                    }
                    if (veh.getOut() == 5){
                        System.out.println(String.format(" - %s got an accident", veh.getPilotName()));
                    }else if (veh.getOut() > 0){
                        System.out.println(String.format(" - %s is still out",veh.getPilotName()));
                    }else{
                        System.out.println(String.format(" - %s advanced %d/%d",veh.getPilotName(),veh.getDistanceTraveled(),Nbrtours));
                    }
                }

            }
        }
        Vehicule[] FinishLine = new Vehicule[AllVehicles.size()];
        int i=0;
        for (Vehicule veh : Finish){
            FinishLine[i] = veh;
            i++;
        }
        return FinishLine;
    }
}
