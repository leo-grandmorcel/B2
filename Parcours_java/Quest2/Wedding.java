package Quest2;
import java.util.Set;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;

public class Wedding {
    public static Map<String, String> createCouple(Set<String> first, Set<String> second) {
        if (first==null || second == null){
            return null;
        }
        Map<String,String> Dico = new HashMap<>();
        Iterator<String> un = first.iterator();
        Iterator<String> deux= second.iterator();
        while (un.hasNext() && deux.hasNext()){
            Dico.put(un.next(),deux.next());
        }
        return Dico;
    }
}