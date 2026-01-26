package Pengurutan;

import java.util.Scanner;

public class SelectionSort {
    public static final String GREEN = "\u001B[32m";
    public static final String SET = "\u001B[0m";
    public static void main(String[] args) throws InterruptedException {
        Scanner scanner = new Scanner(System.in);



        System.out.println("Selamat datang di Bubble Selection Sort");
        Thread.sleep(500);
        

 
        System.out.print("Masukkan jumlah elemen: ");
        int n = scanner.nextInt();

        int[] arr = new int[n];


        System.out.println("Masukkan elemen-elemen array:");
        for (int i = 0; i < n; i++) {
            System.out.print("Elemen ke-" + (i + 1) + ": ");
            arr[i] = scanner.nextInt();
        }

  
        selectionSort(arr);

       
        System.out.println(GREEN+ "Array setelah diurutkan (Selection Sort):");
        for (int num : arr) {
            System.out.print(GREEN+ num + " "+SET);
            Thread.sleep(500);
        }
    }

   
    public static void selectionSort(int[] arr) {
        int n = arr.length;

        for (int i = 0; i < n - 1; i++) {
  
            int minIndex = i;
            for (int j = i + 1; j < n; j++) {
                if (arr[j] < arr[minIndex]) {
                    minIndex = j;
                }
            }

       
            int temp = arr[minIndex];
            arr[minIndex] = arr[i];
            arr[i] = temp;


            
        }
    }
}


        








