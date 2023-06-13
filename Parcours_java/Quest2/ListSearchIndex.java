package Quest2;
import java.util.ArrayList;
import java.util.List;

public class ListSearchIndex {
    public static Integer findLastIndex(List<Integer> list, Integer value) {
        if (list == null ||list.isEmpty()|| value ==null){
            return null;
        }
        int response = list.lastIndexOf(value);
        if (response==-1){
            return null;
        };
        return response;
    }
    public static Integer findFirstIndex(List<Integer> list, Integer value) {
        if (list == null || list.isEmpty() || value ==null){
            return null;
        }
        int response = list.indexOf(value);
        if (response==-1){
            return null;
        };
        return response;
    }
    public static List<Integer> findAllIndexes(List<Integer> list, Integer value) {
        List<Integer> tmp=new ArrayList<>();
        if (list == null|| value ==null||list.isEmpty()){
            return tmp;
        }
        for (int i=0;i<list.size();i++){
            if (list.get(i).equals(value)){
                tmp.add(i);
            }
        }
        return tmp;
    }
}



