package bimabelajarjava;
import java.util.Scanner;
public class PercabanganIF {
    public static void main(String[] args) {
        int nilai;

        Scanner in = new Scanner(System.in);
        
        System.out.print("masukkan nilai kamu : ");
        nilai = in.nextInt();

        if(nilai >= 70) {
            System.out.println("Selamat anda lulus");
        }else{
            System.out.println("maaf, anda gagal");
        }

    }

}
