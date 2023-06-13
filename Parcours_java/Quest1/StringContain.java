package Quest1;
public class StringContain {
    public static boolean isStringContainedIn(String subString, String s) {
        if (s==null || subString==null){
            return false;
        }
        return s.contains(subString);
    }
}
