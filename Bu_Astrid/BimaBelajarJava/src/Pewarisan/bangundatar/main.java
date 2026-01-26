package bangundatar;

import java.util.Scanner;

public class main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("=== Program Menghitung Bangun Datar ===");
        System.out.println("1. Persegi");
        System.out.println("2. Lingkaran");
        System.out.println("3. Persegi Panjang");
        System.out.println("4. Segitiga");
        System.out.print("Pilih bangun datar (1-4): ");
        int pilihan = sc.nextInt();

        switch (pilihan) {
            case 1:
                Persegi persegi = new Persegi();
                persegi.proses();
                break;
            case 2:
                Lingkaran lingkaran = new Lingkaran();
                lingkaran.proses();
                break;
            case 3:
                PersegiPanjang pp = new PersegiPanjang();
                pp.proses();
                break;
            case 4:
                Segitiga segitiga = new Segitiga();
                segitiga.proses();
                break;
            default:
                System.out.println("Pilihan tidak valid.");
        }
    }
}