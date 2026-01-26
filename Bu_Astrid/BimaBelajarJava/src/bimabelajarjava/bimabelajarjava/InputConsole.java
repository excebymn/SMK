package bimabelajarjava;
import java.io.Console;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

/**
 *
 * @author PC 17
 */
public class InputConsole {
    public static void main(String[] args) {
        String nama;
        int umur;
        
        Console input = System.console();
        
        System.out.print("masukkan nama ");
        nama = input.readLine();
        System.out.print("masukkan umur");
        umur = Integer.parseInt(input.readLine());
        


        System.out.println("namamu adalah "+nama);
        System.out.println("umurmu adalah "+umur);

    }}