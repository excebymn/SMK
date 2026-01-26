package bangundatar;

import java.util.Scanner;

public class Persegi extends BangunDatar {
    int sisi;

    public void input() {
        Scanner sc = new Scanner(System.in);
        System.out.print("Masukkan sisi persegi: ");
        sisi = sc.nextInt();
    }

    @Override
    public void luas() {
        int luas = sisi * sisi;
        System.out.println("Luas Persegi: " + luas);
    }

    @Override
    public void keliling() {
        int keliling = 4 * sisi;
        System.out.println("Keliling Persegi: " + keliling);
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