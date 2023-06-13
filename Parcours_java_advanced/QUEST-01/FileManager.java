import java.io.*;

public class FileManager {
    public static void createFile(String fileName, String content) throws IOException {
        File file = new File(fileName);
        file.createNewFile();
        FileWriter write = new FileWriter(file);
        write.write(content);
        write.close();
    }
    public static String getContentFile(String fileName) throws IOException {
        BufferedReader red =new BufferedReader(new FileReader(fileName));
        String content="";
        String tmp;
        while ((tmp = red.readLine()) != null){
            content += tmp;
            content += "\n";
        }
        return content;
    }
    public static void deleteFile(String fileName) {
        File file = new File(fileName);
        file.delete();
    }
}