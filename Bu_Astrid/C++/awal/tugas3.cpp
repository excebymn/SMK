#include <iostream>
using namespace std;


int main()
{
cout << "SELAMAT DATANG DI PERMAINAN KITA" << endl;
cout << "Gawat!! putri dalam bahaya!! sang putri dikutuk oleh penyihir dan membutuhkan bantuanmu" << endl;
cout << "Disini kamu harus menemukan 7 kekuatan ajaib untuk meningkatkan kekuatan dan membebaskan sang putri bernama Christy" << endl;
cout << "hati hati, jika kamu bertemu dengan wraith yang tidur, maka kamu akan mati" << endl;



int data[4][6] = {                                                                                                                                                           
  {0,1,1,1,0,-1}, //01,02,03
  {0,-1,1,-1,0,1},//12,15
  {1,0,0,-1,-1,-1},//20
  {-1,-1,1,-1,-1,-1}//33,
};


int hits = 0;
int numberOfTurns = 0;
int keputusan;

while (hits < 7) {
  int row, column;

  cout << "pilih koordinat tempat kamu menuju";


  cout << "pilih koordinat x tempat kamu turun dari angka angka dibawah!!" << endl;
  cout << "0,1,2,3" << endl;
  cin >> row;


  cout << "pilih koordinat x tempat kamu turun dari angka angka dibawah!!" << endl;
  cout << "0,1,2,3,4,5,6" << endl;
  cin >> column;

 
  if (data[row][column] == 1) { 
    data[row][column] = 0;


    hits++;
     cout << "kamu menemukan kunci!! kekuatanmu sudah menyentuh " << hits << ", tinggal " << (7-hits) << "lagi!!.\n\n" << endl;
       numberOfTurns++;
       cout << ".__________________________________________________________." << endl;

  } else if (data[row][column] == -1){

cout << " yahh, kamu membangunkan wraith!!kamu telah matii!!" << endl;
cout << ".__________________________________________________________." << endl;
hits = 19;
  } else {

    cout << "yahh, gaada apa apa lagi disini, cari tempat lain\n\n";
    cout << ".__________________________________________________________." << endl;
  }


  numberOfTurns++;
}

if (hits == 7) {
  cout << "akhirnya kamu berhasil menyelamatkan putri!!,putri christy sangat mencintaimu, kamu diangkat menjadi raja selanjutnya dan kalian mempunyuai 4 anak, kalian hidup bahagia bersama selamanya (bayangkan)" << endl;
cout << " kamu berhasil menyelesaikan dalam " << numberOfTurns << "percobaan" << endl;
} else {
  cout << "kamu gagal menyelamatkan putrii!!" << endl;
cout << " kamu telah mencoba dalam " << numberOfTurns << " percobaan" << endl;
}





}
