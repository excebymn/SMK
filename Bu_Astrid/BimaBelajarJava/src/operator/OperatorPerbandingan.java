package operator;

public class OperatorPerbandingan {
public static void main(String[] args) {
    //hasilnya akan menjadi boolean(true dan false)

    int a = 10, b= 20;
    boolean hasil;

    hasil = a<b;
    System.out.println("a < b = "+hasil);

    hasil = a>b;
    System.out.println("a > b = "+hasil);

    hasil = a<=b;
    System.out.println("a <= b = "+hasil);

    hasil = a>=b; 
    System.out.println("a >= b = "+hasil);

    hasil = a==b; //sama dengan
    System.out.println("a == b = "+hasil);

    hasil = a!=b; //tidak sama dengan
    System.out.println("a != b = "+hasil);


}
}
