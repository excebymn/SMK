package operator;

public class OperatorPenugasan {
public static void main(String[] args) {
    int a = 20, b = 10;

b += a; //b = b+a
System.out.println("penjumlahan dan pengisian = "+b);

b -= a; //b = b-a
System.out.println("pengurangan dan pengisian = "+b);

b *= a; //b = b*a
System.out.println("perkalian dan pengisian = "+b);

b /= a; //b = b/a
System.out.println("pembagian dan pengisian = "+b);

b %= a; //b = b%a
System.out.println("hasil bagi dan pengisian = "+b);
}
}
