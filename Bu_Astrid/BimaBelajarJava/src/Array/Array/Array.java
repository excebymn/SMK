package Array;
import java.util.Scanner;
public class Array {
public static void main(String[] args) throws InterruptedException {
    Scanner input = new Scanner(System.in);

System.out.println("data apa yang pengen kamu masukkan? ");
String data = input.next();
System.out.println("berapa data yang ingin kamu masukkan?");
int jumlah = input.nextInt();
    String[] nama = new String[jumlah];

System.out.println("kamu bisa masukin "+jumlah+" nama "+data+" yang kamu suka");
    for (int i = 0; i < nama.length; i++) {

        int b = i+1;

        System.out.print("masukkan nama "+data+" ke "+b+" : ");
        nama[i] = input.next();

    }
System.out.println("data yang diinputkan : ");
for (String n : nama) {
    System.out.print(n+",  ");
    Thread.sleep(100);
}
}
}
