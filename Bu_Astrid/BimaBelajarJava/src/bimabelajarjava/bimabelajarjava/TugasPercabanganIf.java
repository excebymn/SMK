package bimabelajarjava;
import java.util.Scanner;
public class TugasPercabanganIf {
    public static void main(String[] args) {
        
        int total;
        
        Scanner input = new Scanner(System.in);
        
        System.out.println("Belanjaan anda tadi berapa? ");
        total = input.nextInt();
        
        int hasil = 0;
              
     
        
        if (total >= 1000000) {
            System.out.println("Selamat anda dapat diskon 50%");
               hasil = (int) (total - (total * 0.5));
               System.out.println(", ANDA PERLU BAYAR : "+hasil);
            
        }else if (total >= 500000){
            System.out.print("Selamat anda dapat diskon 20%");
            hasil = (int) (total - (total * 0.2)); 
            System.out.println(", ANDA PERLU BAYAR : "+hasil);
            
        }else if (total >= 100000) {
            System.out.println("Selamat anda dapat diskon 10%");
                    hasil = (int) (total - (total * 0.1)); 

         System.out.println(", ANDA PERLU BAYAR : "+hasil);
        }else {
            System.out.println("terima kasih sudah berbelanja, tapi maaf ya, anda tidak mendapat");
        }

       
    }
}
