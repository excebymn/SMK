package perulangan;
import java.util.Scanner;
public class perulanganNestedFor {

        public static void main(String[] args) {
    Scanner input = new Scanner(System.in);

            int a,b,c;

System.out.print("MASUKKAN BARIS TERBANYAK  ");
c = input.nextInt();

            for (a = 0; a <= c ;a++){
                for( c = 0; a <= c; a++){
                    System.out.println("*");
                }
                System.out.println();
            }
        }    
    }

