package Quest1;
public class Palindrome {
    public static boolean isPalindrome(String s) {
        if (s==null){
            return false;
        }
        return s.toUpperCase().equals(new StringBuilder(s).reverse().toString().toUpperCase());
    }
}