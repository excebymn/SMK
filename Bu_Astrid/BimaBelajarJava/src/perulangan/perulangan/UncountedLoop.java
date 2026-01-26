package perulangan;
import java.util.Scanner;
public class UncountedLoop {
public static void main(String[] args) {
    boolean running = true;
    int counter = 0;
    String jawab;
    Scanner input = new Scanner(System.in);

    while ( running ) {
        System.out.println("apakah kamu ingin keluar(y/t)");

        jawab = input.next();

        if (jawab.equalsIgnoreCase("y")){

            running = false;

        }
        counter++;
    }
    System.out.println("kamu sudah melakukan perulangan sebanyak"+counter+" kali");
}
}
