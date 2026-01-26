package perulangan;

import java.util.Scanner;

public class Or {
public static void main(String[] args) {
    Scanner input = new Scanner(System.in); 

    int absen, tgl, x, i;

    System.out.print("masukkan nomor absen = ");
    absen = input.nextInt();
    System.out.print("masukkan tanggal lahir ");
    tgl = input.nextInt();
    System.out.print("berapa kali? ");
    x = input.nextInt() *tgl;

for (int hitungan = absen; hitungan <= x; hitungan = absen += tgl) 


    System.out.println(" "+hitungan);
}
}
