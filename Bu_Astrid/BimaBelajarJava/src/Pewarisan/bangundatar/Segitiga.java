package bangundatar;

import java.util.Scanner;

public class Segitiga extends BangunDatar {
    int alas, tinggi;

    public void input() {
        Scanner sc = new Scanner(System.in);
        System.out.print("Masukkan alas: ");
        alas = sc.nextInt();
        System.out.print("Masukkan tinggi: ");
        tinggi = sc.nextInt();
    }

    @Override
    public void luas() {
        double luas = 0.5 * alas * tinggi;
        System.out.println("Luas Segitiga: " + luas);
    }

    @Override
    public void keliling() {
        double miring = Math.sqrt(alas * alas + tinggi * tinggi);
        double keliling = alas + tinggi + miring;
        System.out.println("Keliling Segitiga (diasumsikan siku-siku): " + keliling);
    }

    public void proses() {
        input();
        Scanner sc = new Scanner(System.in);
        System.out.println("1. Hitung Luas");
        System.out.println("2. Hitung Keliling");
        System.out.println("3. Hitung Keduanya");
        System.out.print("Pilih operasi (1-3): ");
        int pilih = sc.nextInt();

        switch (pilih) {
            case 1: luas(); break;
            case 2: keliling(); break;
            case 3: luas(); keliling(); break;
            default: System.out.println("Pilihan tidak valid.");
        }
    }
}
