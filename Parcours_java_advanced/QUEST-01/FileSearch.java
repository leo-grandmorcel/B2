import java.io.*;
import java.util.ArrayList;
public class FileSearch {
    public static String Path = "documents";
    public static String searchFile(String fileName) {
        ArrayList<File> dossiers = new ArrayList<File>();
        File doc = new File(Path);
        for (File fichier : doc.listFiles()){
            if (fichier.isDirectory()){
                dossiers.add(new File(Path + "/" + fichier.getName()));
            }else if(fichier.getName().equals(fileName)){
                return fichier.getPath();
            }
        }
        for (File fichier : dossiers){
            Path = fichier.getPath();
            if (searchFile(fileName)!=null){
                return Path+"/"+fileName;
            };
        }
        return null;
    }
}