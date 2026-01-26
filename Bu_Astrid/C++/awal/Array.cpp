#include <iostream>
#include <vector>
using namespace std;

int main()
{
    vector <string> bike = {"Kawasaki" , "BMW" , "Yamaha" , "Ducati", "KTM", "Vespa", "Benelli", "TVS", "Suzuki", "Harley"};


    for (int i=0; i<10; i++){
            cout << "kamu dapat sepeda ke" << i+1 << ":" << bike[i]<<endl;
    }
    //for each
    for (string sepeda : bike){
        cout << sepeda << "\n";
    }


int number[] = {19,20,21,23};
int i;
int lenghth = sizeof(number) / sizeof(number[0]);
int min = number[0];

for (i = 0; i<lenghth; i++){
    if(min > number[i]){
        min = number[i];
    }
}
cout << "nilai terkecil dari data tersebut adalah........." << min;
return 0;


}


