import java.util.regex.Pattern;

public class RegexReplace {
    public static String removeUnits(String s) {
        return s.replaceAll("(\\d)((cm|€)(\\s|$))", "$1 ").trim();
    }
    
    public static String removeFeminineAndPlural(String s) {
        s = s.replaceAll("[sx]\\b","");
        s = s.replaceAll("e\\b", "");
        return s.replaceAll("ell\\b", "el");
    }
}