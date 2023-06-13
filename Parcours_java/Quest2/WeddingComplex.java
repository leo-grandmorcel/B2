package Quest2;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.Set;


public class WeddingComplex {
    public static Map<String, List<String>> First;
    public static Map<String, List<String>> Second;
    private static <K, V> K getKey(Map<K, V> map, V value) {
      for (Entry<K, V> entry : map.entrySet()) {
          if (entry.getValue().equals(value)) {
              return entry.getKey();
          }
      }
      return null;
    }   
    public static Map<String, String> createBestCouple(Map<String, List<String>> first, Map<String, List<String>> second) {
        First = first;
        Second = second;
        var Homme = new HashSet<>(First.keySet());
        var Femme = new HashSet<>(Second.keySet());
        return Reccursive(Homme, Femme, new HashMap<>());
    }
    public static Map<String,String> Reccursive(Set<String> homme,Set<String> femme, Map<String, String> result){
        if (homme.size()==0){
            return result;
        }
        var current = homme.iterator().next();
        for(String name : First.get(current)) {
            if (femme.contains(name)){
                result.put(current, name);
                femme.remove(name);
                homme.remove(current);
                return Reccursive(homme, femme, result);
            }
            var proposal = getKey(result, name);
            if (Second.get(name).indexOf(current) < Second.get(name).indexOf(proposal)){
                result.remove(proposal);
                result.put(current,name);
                homme.add(proposal);
                homme.remove(current);
                return Reccursive(homme, femme, result);
            }
        }
        return result;
    }
}