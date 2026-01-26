#include <iostream>
using namespace std;


int main()
{



//letak kapal 01,02,22,32
bool ships[4][4] = {                                                                                                                                                           
  { 0, 1, 1, 0 },
  { 0, 0, 0, 0 },
  { 0, 0, 1, 0 },
  { 0, 0, 1, 0 }
};

// variable untuk menyimpan jumlah hit dan percobaan pemain
int hits = 0;
int numberOfTurns = 0;

// perulangan biar pemain bisa memilih sampek 4 kapal
while (hits < 4) {
  int row, column;

  cout << "Selecting coordinates\n";

  // pertanyaan di gamenya, baris
  cout << "Choose a row number between 0 and 3: ";
  cin >> row;

  // pertanyaan buat kolom
  cout << "Choose a column number between 0 and 3: ";
  cin >> column;

  // mengcek hasil jawaban
  if (ships[row][column]) {
    // 
    ships[row][column] = 0;

    // jika benar menambha nilai hit 
    hits++;

    // mengkasih tau berapa yang tersisa
    cout << "Hit! " << (4-hits) << " left.\n\n";
  } else {
    // else nya pasti ngasih tau kalo dia gagal pas itu
    cout << "Miss\n\n";
  }


  numberOfTurns++;
}

cout << "Victory!\n";
cout << "You won in " << numberOfTurns << " turns";
}