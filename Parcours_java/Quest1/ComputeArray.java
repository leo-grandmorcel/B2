package Quest1;
public class ComputeArray {
    public static int[] computeArray(int[] array) {
        if (array==null){
            return null;
        }
        int tmp[] = new int[array.length];
        for (int i=0;i<array.length;i++){
            if (array[i]%3==0){
                tmp[i]= array[i]*5;
            }else if (array[i]%3==1){
                tmp[i] = array[i]+7;
            }else {
                tmp[i]= array[i];
            }
        }
        return tmp;
    }
}