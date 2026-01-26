
package VideoBuAstrid;



/**
 *
 * @author zoan
 */
import java.util.Scanner;


import java.util.Scanner;

public class Jadwal {





    public static void main(String[] args) {

        Scanner in = new Scanner(System.in);
        String hari;
        String ulang;

        System.out.println("----------------------------------------");
        System.out.println("Program Jadwal Pelajaran Harian");
        System.out.println("----------------------------------------");

        do {
            System.out.print("\nHari apa sekarang? : ");
            hari = in.next().toLowerCase(); // agar tidak case sensitive

            System.out.println(); // untuk pemisah

            switch (hari) {
                case "senin":
                    System.out.println("Jadwal di hari Senin:");
                    System.out.println("- Matematika");
                    System.out.println("- Bahasa Indonesia");
                    System.out.println("- DDPPLG");
                    break;

                case "selasa":
                    System.out.println("Jadwal di hari Selasa:");
                    System.out.println("- Seni Budaya");
                    System.out.println("- Bahasa Indonesia");
                    System.out.println("- DDPPLG");
                    break;

                case "rabu":
                    System.out.println("Jadwal di hari Rabu:");
                    System.out.println("- Bahasa Inggris");
                    System.out.println("- PKN");
                    System.out.println("- Informatika");
                    break;

                case "kamis":
                    System.out.println("Jadwal di hari Kamis:");
                    System.out.println("- Matematika");
                    System.out.println("- Sejarah");
                    System.out.println("- PJOK");
                    break;

                case "jumat":
                    System.out.println("Jadwal di hari Jumat:");
                    System.out.println("- Bahasa Arab");
                    System.out.println("- Agama");
                    System.out.println("- Projek P5");
                    break;

                case "sabtu":
                    System.out.println("Hari Sabtu libur, istirahat yaa!");
                    break;

                case "minggu":
                    System.out.println("Hari Minggu libur total, jangan mikirin sekolah yaa~");
                    break;

                case "januari":
                    System.out.println("Menampilkan lirik: Terima Kasih Pak Jokowi\n");
                    String[] lirik = {
                        "Terima kasih Pak Jokowi",
                        "Ribuan desa telah kau datangi",
                        "Kau menyemangati, ",
                        "kau memberi arti",
                        "Untuk negeri",
                        "Terima kasih Pak Jokowi",
                        "Hanya Tuhan yang mampu membalas",
                        "Kebaikan hati yang selalu kau beri",
                        "Untuk negeri",
                        "Terima kasih Pak Jokowi",
                        "Ribuan desa telah kau datangi",
                        "Kau menyemangati, kau memberi arti",
                        "Untuk negeri",
                        "Terima kasih Pak Jokowi",
                        "Hanya Tuhan yang mampu membalasi",
                        "Kebaikan hati yang selalu kau beri",
                        "Untuk negeri"
                    };

                    for (String baris : lirik) {
                        System.out.println(baris);
                        try {
                            Thread.sleep(750); // delay 750ms
                        } catch (InterruptedException e) {
                            System.out.println("Terjadi kesalahan saat menampilkan lirik.");
                        }
                    }
                    break;

                default:
                    System.out.println("Maaf, input hari tidak dikenali.");
                    System.out.println("Pastikan kamu menulis nama hari dengan benar (contoh: senin, selasa, dll)");
                    break;
            }

            System.out.print("\nApakah kamu mau cek lagi? (ya/tidak) : ");
            ulang = in.next().toLowerCase();

        } while (ulang.equals("ya"));

        System.out.println("\nTerima kasih telah menggunakan program ini. Sampai jumpa!");

        in.close();
    }
}