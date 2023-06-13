public class Bet {
    private String PilotName;
    private int Money;

    public String getPilotName(){
        return PilotName;
    }
    public int getMoney(){
        return Money;
    }

    public int Win(Vehicule[] vehs){
        for (int i=0;i<3;i++){
            if (vehs[i].getPilotName()==PilotName){
                return Money * 2;
            }
        }
        return Money * -2;
    }
    public String toString(){
        return String.format("Bet %d€ on %s", Money,PilotName);
    }
}
