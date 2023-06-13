package Quest3;
import java.util.*;

public class Galaxy {
    private List<CelestialObject> celestialObjects;
    public Galaxy(){
        celestialObjects = new ArrayList<CelestialObject>();
    }
    public List<CelestialObject> getCelestialObjects(){
        return celestialObjects;
    }
    public void addCelestialObject(CelestialObject object){
        celestialObjects.add(object);
    }
    public Map<String,Integer> computeMassRepartition(){
        int MassStar=0;
        int MassPlanet=0;
        int MassOther=0;
        for (CelestialObject obj1: celestialObjects){
            if (obj1 instanceof Star){
                MassStar += obj1.getMass();
            }else if (obj1 instanceof Planet){
                MassPlanet += obj1.getMass();
            }else{
                MassOther += obj1.getMass();
            }
        }
        Map<String, Integer> result = new HashMap<>();
        result.put("Star", MassStar);
        result.put("Planet",MassPlanet);
        result.put("Other",MassOther);
        return result;
    }
}
