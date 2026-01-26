package bimabelajarjava;
import java.util.Scanner;
public class gabut {

        public static void main(String[] args) throws InterruptedException {
            Scanner input = new Scanner(System.in); 




    int i, j;
    String k;
    boolean running = true;
        int counter = 0;
        String jawab;






    while (running) {
    System.out.println("berapa kali?");
    int l = input.nextInt();

    System.out.println("berapa baris?");
    int m = input.nextInt();


    System.out.println("kata kata?");
    k = input.next();



        for (i = 0; i < m; i++) {
            for (j = 0; j <= l; j++) {
                System.out.print(k+" ");
                Thread.sleep(25);
            }
            System.out.println();
        }
        System.out.println("apakah kamu ingin keluar(ya/tidak)");

        jawab = input.next();

        if (jawab.equalsIgnoreCase("ya")) {

            running = false;

        }
        counter++;
    }
    System.out.println("kamu sudah melakukan perulangan sebanyak" + counter + " kali");
    System.out.println("makasih ya");
    }

}
