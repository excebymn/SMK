
package bimabelajarjava;

/**
 *
 * @author PC 17
 */
public class BimaBelajarJava { 
    
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
    String judulNovel, namaPengarang, penerbit, bahasa;
        int tahun, jumlahHalaman;
        double berat;
        
        judulNovel = "Hujan";
        namaPengarang = "Tere Liye";
        penerbit = "Gramedia Pustaka Utama";
        tahun = 2016;
        jumlahHalaman = 320;
        berat = 500;
        bahasa = "Indonesia";
        
        System.out.println("Judul : "+judulNovel); 
        System.out.println("Nama Pengarang : "+namaPengarang); 
        System.out.println("Penerbit : "+penerbit); 
        System.out.println("Tahun : "+tahun); 
        System.out.println("Jumlah Halaman : "+jumlahHalaman);
        System.out.println("Berat : "+berat+" gram");
        System.out.println("Bahasa : "+bahasa);
        
    }
    
}