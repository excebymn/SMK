#include <iostream>
#include <string>

using namespace std;

int main() {

    string teman[] = {"rendy", "bima", "fauzan", "rombong", "yesa" "abid", "azka",};
    int length = sizeof(teman) / sizeof(teman[0]);

    string request;
    cout << "Siapa yang ingin kamu cari? ";
    cin >> request;


    bool found = false;
    for (int i = 0; i < length; i++) {
        if (teman[i] == request) {
            found = true;
            break;

        }
    }
    if (found) {
        cout << "Nama " << request << " ada dalam data." << endl;



    } else {
        cout << "Nama " << request << " tidak ada dalam data." << endl;
    }
    return 0;
}
