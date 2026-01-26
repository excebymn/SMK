#include <iostream>
#include <cstdlib> 
#include <ctime>    
using namespace std;


void Riwayat(int tebakan[], int jumlah) {
    cout << "Riwayat tebakan: ";
    for (int i = 0; i < jumlah; i++) {
        cout << tebakan[i] << " ";
    }
    cout << endl;
}


void tebakAngka() {
    srand(time(0)); 
    int angkaRahasia = rand() % 100 + 1; 
    int tebakan[5]; 
    int kesempatan = 5;
    bool menang = false;

    cout << "\033[34m" <<   "=== GAME TEBAK ANGKA ===" << "\033[0m"   << endl;
    cout << "\033[34m" <<   "Saya telah memilih angka antara 1 hingga 100." << "\033[0m"   << endl;
    cout << "\033[34m" <<   "Anda memiliki " << kesempatan << " kesempatan untuk menebaknya.\n" << "\033[0m"   << endl;

    for (int i = 0; i < kesempatan; i++) {
        cout << "Tebakan ke-" << (i + 1) << ": ";
        cin >> tebakan[i];

       
        if (tebakan[i] == angkaRahasia) {
            cout << "\033[32m" <<  "Selamat! Anda menebak dengan benar!" << "\033[0m"   << endl;
            menang = true;
            break;
        } else if (tebakan[i] > angkaRahasia) {
            cout << "\033[33m" <<  "Terlalu tinggi! Coba lagi." << "\033[0m"   << endl;
        } else {
            cout << "\033[32m" <<   "Terlalu rendah! Coba lagi." << "\033[0m"  << endl;
        }
    }

  
    if (!menang) {
        cout << "\033[31m" << "Sayang sekali, Anda kehabisan kesempatan." << "\033[0m"   << endl;
        cout << "\033[31m" << "Angka yang benar adalah: " << angkaRahasia <<  "\033[0m"  << endl;
    }

   
    Riwayat(tebakan, kesempatan);
}

int main() {
    char mainLagi;
    do {
        tebakAngka();
        cout << "Main lagi? (y/n): ";
        cin >> mainLagi;
    } while (mainLagi == 'y' || mainLagi == 'Y');

    cout << "Terima kasih telah bermain!" << endl;
    return 0;
}