package ppppp;

public class Main {
    public static void main(String[] args) {
        Drone xx = new Drone();

        xx.energi = 100;
        xx.kecepatan = 0;
        xx.ketinggian = 0;
        xx.merek = "infinix";

        xx.terbang();
        xx.maju();
        xx.mundur();
        xx.belok();
        xx.turun();
        xx.matikanMesin();

    }
}
