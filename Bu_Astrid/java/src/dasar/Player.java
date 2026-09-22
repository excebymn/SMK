package dasar;

public class Player {
    String name;
    int speed;
    int healthpoint;

    void run(){
        System.out.println(name + "is running");
        System.out.println(("speed " +speed));
    }

    boolean isDead(){
        if ( healthpoint <= 0);
    }

   
}