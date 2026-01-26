#include <iostream>
using namespace std;
// untuk menyimpan suatu perintah
void luasPersegi(int s)
{
    int l = s*s;
    cout << "luas nya adalah "<< l << " cm kuadrat "<< endl; 
}

int volumePersegi(int s){
    int l = s*s*s;
    return l;
}

int main()
{
    int jawaban,s;
    cout << "SELAMAT DATANG DI PROGRAM PERHITUNGAN KAMI" << endl;
    cout << "kamu bisa memilih beberapa perhitungan dibawah" << endl;
    cout << "1. luas persegi " << endl;
    cout << "2. volume persegi " << endl;
    cin >> jawaban;

    switch (jawaban)
    {
    case 1:
        cout << "masukkan sisi" <<endl;
        cin >> s;
        luasPersegi(s);
        break;
    case 2:
        cout << "masukkan sisi" << endl;
        cin >> s;
        cout << volumePersegi(s);
    break;
    
    default:
        break;
    }
}