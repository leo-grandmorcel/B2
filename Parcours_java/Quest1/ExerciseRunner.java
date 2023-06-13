package Quest1;
public class ExerciseRunner {
    public static void main(String[] args) {
        int[] array = ComputeArray.computeArray(new int[]{-1, -2, 0, -3, -4, -5, -6,-8});
        for (int i : array) {
            System.out.print(i + " ");
        }
    }
}
