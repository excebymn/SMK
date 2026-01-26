package perulangan;
import java.util.Scanner;
public class TugasChallenge {

    public static void main(String[] args) {

        boolean running = true;
        int counter = 0;
        String jawab;
        Scanner input = new Scanner(System.in);

        int answer;
        Double pi, luasLingkaran, luasPersegi, s, panjang, lebar, luasPP, a, b, t, luasTrap, alas, tinggi, luasSegitiga,
                r;
       do {

            System.out.println("Selamat Datang Di Progam Kami yaa");
            System.out.println("Kamu Bisa Menggunakan Program Ini Dengan Mengetik : ");
            System.out.println("  1 untuk luas segitiga");
            System.out.println("  2 untuk luas lingkaran");
            System.out.println("  3 untuk luas persegi");
            System.out.println("  4 untuk luas persegi panjang");
            System.out.println("  5 untuk luas trapesium");
            System.out.println("  6 untuk menghitung rasa cintaku padamu");
            System.out.println("  7 untuk sebuah kata kata");

            System.out.print("SILAHKAN MASUKKAN JAWABAN >> ");
            answer = input.nextInt();

            if (answer == 1) {
                System.out.print("silahkan masukkan alas : ");
                alas = input.nextDouble();
                System.out.print("silahkan masukkan tinggi : ");
                tinggi = input.nextDouble();
                luasSegitiga = (alas * tinggi) / 2;
                System.out.println("Nahh, luas segitiga yang kamu cari adalah  " + luasSegitiga + "cm");

            } else if (answer == 2) {
                pi = 3.14;
                System.out.print("masukkan jari jari lingkaran : ");
                r = input.nextDouble();
                luasLingkaran = pi * (r * r);
                System.out.println("Owalah, luas Lingkaran yang kamu cari adalaah  " + luasLingkaran + "cm");
            } else if (answer == 3) {
                System.out.print("silahkan masukkan panjang sisi : ");
                s = input.nextDouble();

                luasLingkaran = s * s;
                System.out.println("luas lingkarannya ituu " + luasLingkaran + " bree");

            } else if (answer == 4) {
                System.out.print("masukkan panjang : ");
                panjang = input.nextDouble();
                System.out.print("masukkan lebarnya juga : ");
                lebar = input.nextDouble();
                luasPP = panjang * lebar;
                System.out.println("luas persegi panjangnya " + luasPP + "cm");

            } else if (answer == 5) {
                System.out.print("masukkan sisi sejajar pertama : ");
                a = input.nextDouble();
                System.out.print("masukkan sisi sejajar kedua : ");
                b = input.nextDouble();
                System.out.print("masukkan tinggi : ");
                t = input.nextDouble();
                luasTrap = t * (a + b) / 2;
                System.out.println("luas trapesiumnya : " + luasTrap + "cm");

            }else if (answer == 6){
                System.out.println("are you kidding me? rasa cintaku padamu itu unlimited lohh, meskipun kamu tidak menerimanya, tapi aku bersedia untuk tetap menunggu");

            }else if (answer == 7) {

               System.out.println("Jika ada 100 orang yang mencintaimu, aku adalah salah satunya");
               System.out.println("Jika hanya ada 1 orang yang mencintaimu, itu adalah aku");
               System.out.println("Dan jika sudah tidak ada lagi seorang pun yang mencintaimu, artinya aku sudah mati");
               
            } else {
                System.out.println("maaf, kami tidak mengerti");
            }




            System.out.println("apakah kamu ingin keluar(ya/tidak)");
            jawab = input.next();

        } while (jawab.equalsIgnoreCase("tidak")) ;{

            running = false;

        }
        counter++;

        System.out.println("kamu sudah melakukan perulangan sebanyak" + counter + " kali");
        System.out.println("makasih ya");



    }
    }
