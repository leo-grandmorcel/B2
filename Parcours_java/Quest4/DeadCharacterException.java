public class DeadCharacterException extends Exception{
    private Character character;
    public DeadCharacterException(Character perso){
        character=perso;
    }
    public String getMessage(){
        return String.format("The %s %s is dead.",character.getClass().getName().toLowerCase(), character.getName());
    }
}
