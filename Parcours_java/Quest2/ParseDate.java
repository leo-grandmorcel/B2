package Quest2;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.Locale;

public class ParseDate {
    public static LocalDateTime parseIsoFormat(String stringDate) {
        if (stringDate == null){
            return null;
        }
        return LocalDateTime.parse(stringDate);
    }

    public static LocalDate parseFullTextFormat(String stringDate) {
        if (stringDate == null){
            return null;
        }
        return LocalDate.parse(stringDate,DateTimeFormatter.ofPattern("EEEE dd LLLL yyyy" ,Locale.FRANCE));
    }

    public static LocalTime parseTimeFormat(String stringDate) {
        if (stringDate == null){
            return null;
        }
        return LocalTime.parse(stringDate,DateTimeFormatter.ofPattern("hh 'heures' B, mm 'minutes et' ss 'secondes'" ,Locale.FRANCE));
    }
}