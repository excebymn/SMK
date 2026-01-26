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
public class LuasKelilimgLingkaran {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        
        int r;
        double k, l, pi = 3.14;
        String nama;
        
        System.out.println("_Sugeng Rawuh Ndoroo_");
        System.out.println("Sekarang Kamu Ada di Program Perhitungan Luas dan Keliling Lingkaran");
        System.out.print(" namine njenengan sinten? ");
        nama = input.next();
        System.out.print("owalah, lingkarannya "+nama+" punya jari jari berapa?  ");
        r = input.nextInt();
        System.out.println("siap, akan kami proses");
        System.out.println("_");
        System.out.println("_");
        System.out.println("_");
        System.out.println("_");
        k = 2 * pi * r;
        l = pi * r * r;
        
        System.out.println("nah "+nama+", jadi keliling lingkaran kamu ituu "+k+" cm yaa, dann luasnya itu "+l+" cm");
        System.out.println(" ");
        System.out.println("makasi yaa udah pake program kamii, semoga sehat selalu yaa");
        System.out.println(" ");
        System.out.println("Indonesia Negara Hukum, Wassalamu'alaikum^^ ");
        
        
        
        
        
       
        
    }
    
}
