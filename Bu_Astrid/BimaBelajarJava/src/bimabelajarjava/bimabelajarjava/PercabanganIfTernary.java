package bimabelajarjava;

import java.util.Scanner;

public class PercabanganIfTernary {
    public static void main(String[] args) {
    int nilai;

    Scanner in = new Scanner(System.in);

System.out.println("nilai anda berapa? ");
nilai = in.nextInt();

if (nilai >= 80) {
    System.out.println("A itu");
}else if (nilai >= 60) {
    System.out.println("B itu");
}else if (nilai >= 40) {
    System.out.println("C itu");
}else if (nilai >= 0) {
    System.out.println("D itu");
}
}

        }

    


