public interface Healer {
    public void heal(Character perso) throws DeadCharacterException;
    public int getHealCapacity();
}
