package Quest2;
import java.util.List;

public class ListEqual {
    public static boolean areListEquals(List<String> list1, List<String> list2) {
        if ((list1 !=null && list2 ==null) || (list1 == null & list2 !=null)){
            return false;
        }else if (list1==null || list2==null){
            return true;
        }
        return list1.equals(list2);
    }
}