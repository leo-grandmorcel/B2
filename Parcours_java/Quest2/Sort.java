package Quest2;
import java.util.ArrayList;
import java.util.List;

public class Sort {

    public static List<Integer> sort(List<Integer> list) {
        if (list==null){
            return null;
        }
        List<Integer> tmp = new ArrayList<>(list);
        tmp.sort(Integer::compareTo);
        return tmp;
    }

    public static List<Integer> sortReverse(List<Integer> list) {
        if (list==null){
            return null;
        }
        List<Integer> tmp = new ArrayList<>(list);
        tmp.sort(Integer::compareTo);
        tmp.sort((a,b)-> b.compareTo(a));
        return tmp;
    }
}