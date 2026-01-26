package bangundatar;

import java.util.Scanner;

public class Lingkaran extends BangunDatar {
    double r;

    public void input() {
        Scanner sc = new Scanner(System.in);
        System.out.print("Masukkan jari-jari lingkaran: ");
        r = sc.nextDouble();
    }

    @Override
    public void luas() {
        double luas = Math.PI * r * r;
        System.out.println("Luas Lingkaran: " + luas);
    }

    @Override
    public void keliling() {
        double keliling = 2 * Math.PI * r;
        System.out.println("Keliling Lingkaran: " + keliling);
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