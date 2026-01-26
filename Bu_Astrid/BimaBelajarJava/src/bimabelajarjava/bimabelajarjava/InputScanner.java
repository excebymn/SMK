package bimabelajarjava;
import java.util.Scanner;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

/**
 *
 * @author PC 17
 */
public class InputScanner {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in); 

         
        String nama, kabar;
        int alas, tinggi;
        double luas;
       
        
        System.out.println("Selamat Datang bro");
        System.out.print("nama kamu adalah? ");
        nama = input.next(); 
        System.out.print("jelasin harimu dalam satu kata ");
        kabar = input.next();
        System.out.println("kamu berada di program hitung luas segitiga nih, masukkan panjang tinggi dan alas biar kami bisa menghitungnya");
        System.out.print(">Masukkan Alas : ");
        alas = input.nextInt();
        System.out.print(">Masukkan Tinggi : ");
        tinggi = input.nextInt();
        luas = Double.valueOf((alas * tinggi) / 2);
        System.out.println("jadi, luas segitiga yang kamu maksud adalahh : "+luas+" cm");
        System.out.println("makasi yaa");
    }
}
