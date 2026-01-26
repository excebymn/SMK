package bimabelajarjava;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class InputBufferedReader {
public class InputBufferReader {
    public static void main(String[] args) throws IOException {InputStreamReader obj = new InputStreamReader(System.in);
     BufferedReader input = new BufferedReader(obj);
     int usia;
     double bb;
     
        System.out.print("namamu siapa? ");
        String nama = input.readLine();
        System.out.print("Usiamu berapa  "+nama+" ? ");
        usia = Integer.parseInt(input.readLine());
        System.out.print(" Berapa berat badanmu?  ");
        bb = Double.parseDouble(input.readLine()); 
        System.out.println("_____________________________________________");
        System.out.println("OWALAH GITU TAA, JADII");
        System.out.println("halooo "+nama+"^^, jadi usiamu "+usia+" tahun yaa, terus berat badanmu "+bb+" kg yaa,nice nice");
        System.out.println(" ");
        System.out.println("jadi "+nama+", berjuang tidak ada salahnya, tapi ingat yaa, pemenangnya tetap orang yang dia suka");
        System.out.println("#pesan dari inisial B yang udah tau dan ngalamin sendiri");
    }
                
    }
}
