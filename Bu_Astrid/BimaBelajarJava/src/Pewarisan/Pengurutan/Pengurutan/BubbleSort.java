package Pengurutan;
import java.util.Scanner;
public class BubbleSort {

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


        bubbleSort(arr);


        System.out.println(GREEN+"Array setelah diurutkan (Bubble Sort):");
        for (int num : arr) {
            System.out.print(GREEN+ num + " " +SET);
            Thread.sleep(500);
        }
    }

    public static void bubbleSort(int[] arr) {
        int n = arr.length;
        boolean swapped;

        for (int i = 0; i < n - 1; i++) {
            swapped = false;


            for (int j = 0; j < n - i - 1; j++) {
                if (arr[j] > arr[j + 1]) {
              
                    int temp = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = temp;
                    swapped = true;
                }
            }

 
            if (!swapped) break;
        }
    }
}

