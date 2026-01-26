package Pengurutan;

import java.util.Scanner;

public class InsertionSort {
    public static final String GREEN = "\u001B[32m";
    public static final String SET = "\u001B[0m";
    public static void main(String[] args) throws InterruptedException {
        
        Scanner scanner = new Scanner(System.in);

        System.out.println("Selamat datang di Bubble Sort");
        Thread.sleep(500);
        
        System.out.print("Masukkan jumlah elemen: ");
        int n = scanner.nextInt();

        int[] arr = new int[n];


        System.out.println("Masukkan elemen-elemen array:");
        for (int i = 0; i < n; i++) {
            System.out.print("Elemen ke-" + (i + 1) + ": ");
            arr[i] = scanner.nextInt();
        }

   
        insertionSort(arr);

  
        System.out.println("Array setelah diurutkan (Insertion Sort):");
        for (int num : arr) {
            System.out.print(GREEN+ num + "  "+SET);
            Thread.sleep(600);
        }
    }

   
    public static void insertionSort(int[] arr) {
        int n = arr.length;

        for (int i = 1; i < n; i++) {
            int key = arr[i]; 
            int j = i - 1;

        
            while (j >= 0 && arr[j] > key) {
                arr[j + 1] = arr[j];
                j--;
            }

         
            arr[j + 1] = key;

        }
    }
}