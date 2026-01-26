package operator;

public class OpertatorLogika {
public static void main(String[] args) {
    boolean a = true, b = false, c;

        //AND =  dua dua nya harus benar
        c =  a && b;
        System.out.println("Logika AND = "+c);

        //OR = salah satu harus bener
        c = a || b;
        System.out.println("Logika AND = "+c);

        //NEGASI = sama dengan yang di sebelumnya
        c = !a;
        System.out.println("Logika NEGASI = "+c);


}
}
