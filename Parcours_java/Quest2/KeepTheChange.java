package Quest2;
import java.util.ArrayList;
import java.util.List;
import java.util.Set;

public class KeepTheChange {
    public static List<Integer> computeChange(int amount, Set<Integer> coins) {
        if (amount == 0 || coins == null || coins.isEmpty()){
            return null;
        }
        List<Integer> Result = new ArrayList<>();
        List<Integer> RevCoins = new ArrayList<>(coins);
        RevCoins.sort(Integer::compareTo);
        RevCoins.sort((a,b)-> b.compareTo(a));
        for (Integer coin : RevCoins) {
            while (amount >= coin){
                amount-=coin;
                Result.add(coin);
            }
        }
        return Result;
    }
}