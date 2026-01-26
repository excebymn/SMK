package bimabelajarjava;
import java.util.Scanner;
public class PercabanganDiskon {
public static void main(String[] args) {
    Scanner input = new Scanner(System.in); 

String member;
int harga, belanja;

System.out.println("Selamat Datang !!");
System.out.print("Apakah anda punya kartu member? [jawab dengan ya/tidak]");
member = input.next();
System.out.print("berapa total belanjaan kamu?");
belanja = input.nextInt();


if(member.equalsIgnoreCase("ya")) {
    if (belanja >= 500000){
    harga = belanja - 50000;
    System.out.println("kamu dapat diskon 50000, jadi kamu perlu bayar : "+harga);
    }
    else if(belanja >= 100000){
    harga = belanja - 15000;
    System.out.println("anda dapat diskon 15000, anda perlu bayar Rp."+harga);
    }
    else if (belanja <= 100000){
    System.out.println("maaf, anda tidak dapat diskon :(     anda perlu bayar "+belanja);
    }
}else{
    if (belanja >= 100000){
        harga = belanja - 5000;
        System.out.println("anda dapat diskon 5000, anda perlu bayar "+harga);
    }else{
        System.out.println("maaf, anda tidak dapaat diskon, anda perlu bayar "+belanja);
    }
}
System.out.println("makasih yaa^^");
}


}

