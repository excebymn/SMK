package dasar;
public class Game {
    public static void main(String[] args) {
        Player satu = new Player();
        satu.name = "ucok";
        satu.healthpoint = 80;
        satu.speed = 80;

        satu.run();

        if (satu.isDead()) {
            System.out.println("game over ");
        }
}
}