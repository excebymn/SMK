package perulangan;

import java.util.Scanner;
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ChallengeBerwarna {

        public static final String BLACK = "\u001B[30m";
        public static final String RED = "\u001B[31m";
        public static final String GREEN = "\u001B[32m";
        public static final String YELLOW = "\u001B[33m";
        public static final String BLUE = "\u001B[34m";
        public static final String PURPLE = "\u001B[35m";
        public static final String CYAN = "\u001B[36m";
        public static final String WHITE = "\u001B[37m";
        public static final String SET = "\u001B[0m";

        public static final String RESET = "\u001B[0m";
        public static final String BG_BLACK = "\u001B[40m";
        public static final String BG_RED = "\u001B[41m";
        public static final String BG_GREEN = "\u001B[42m";
        public static final String BG_YELLOW = "\u001B[43m";
        public static final String BG_BLUE = "\u001B[44m";
        public static final String BG_PURPLE = "\u001B[45m";
        public static final String BG_CYAN = "\u001B[46m";
        public static final String BG_WHITE = "\u001B[47m";
    public static void main(String[] args) throws InterruptedException {
   boolean running = true;
        int counter = 0;
        Scanner input = new Scanner(System.in);
        int col = 25, row = 3;
        int answer;
        String jawab;

        while (running) {
            System.out.print(BLUE+"pertama ");
            Thread.sleep(500);
            System.out.print(RED+"akan ");
            Thread.sleep(500);
            System.out.print(YELLOW+"muncul ");
            Thread.sleep(500);
            System.out.print(GREEN+"bendera ");
            Thread.sleep(500);
            System.out.print(PURPLE+"INDONESIA,  ");
            Thread.sleep(500);
            System.out.print(BG_WHITE+RED+"#");
            Thread.sleep(500);
            System.out.print(BLACK+"MAJU");
            Thread.sleep(500);
            System.out.println(GREEN+"INDONESIAKU"+RESET+SET);
            Thread.sleep(500);

System.out.println(BG_RED+"                    "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"                    "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"                    "+RESET);
Thread.sleep(500);
System.out.println(BG_WHITE+"                    "+RESET);
Thread.sleep(500);
System.out.println(BG_WHITE+"                    "+RESET);
Thread.sleep(500);
System.out.println(BG_WHITE+"                    "+RESET);
Thread.sleep(500);

System.out.print(BLUE+"lalu ");
Thread.sleep(500);
System.out.print(RED+"akan ");
Thread.sleep(500);
System.out.print(YELLOW+"muncul ");
Thread.sleep(500);
System.out.print(GREEN+"bendera ");
Thread.sleep(500);
System.out.print(PURPLE+"PALESTINA,  ");
Thread.sleep(500);
System.out.print(BG_WHITE+RED+"#");
Thread.sleep(500);
System.out.print(BLACK+"FREE");
Thread.sleep(500);
System.out.println(GREEN+"PALESTINE"+RESET+SET);
Thread.sleep(500);



System.out.println(BG_RED+" "+BG_BLACK+"                   "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"  "+BG_BLACK+"                  "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"   "+BG_WHITE+"                 "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"   "+BG_WHITE+"                 "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+"  "+BG_GREEN+"                  "+RESET);
Thread.sleep(500);
System.out.println(BG_RED+" "+BG_GREEN+"                   "+RESET);
Thread.sleep(500);

System.out.println("LOADING"+RESET);
Thread.sleep(500);
System.out.println(RED+"0%"+RESET);
Thread.sleep(500);
System.out.println(YELLOW+"25&"+RESET);
Thread.sleep(500);
System.out.println(GREEN+"50%"+RESET);
Thread.sleep(500);
System.out.println(BLUE+"100%"+RESET+SET);
Thread.sleep(500);
System.out.println("LOADING COMPLETED"+RESET);
Thread.sleep(500);




System.out.println(BLACK+"apakah kamu ingin keluar?? (ya/tidak)");

jawab = input.next();

if (jawab.equalsIgnoreCase("ya")) {

    running = false;

}
counter++;
}
Thread.sleep(500);
System.out.println("kamu sudah melakukan perulangan sebanyak" + counter + " kali");
Thread.sleep(500);









for (int i = 0; i <= row; i++) {
    for (int j = 1; j <= col; j++) {

        System.out.print(BG_RED+" "+RESET);
        Thread.sleep(50);
    }
    System.out.println(" ");
}

for (int i = 0; i <= row; i++) {
    for (int j = 1; j <= col; j++) {

        System.out.print(BG_WHITE+" "+RESET);
        Thread.sleep(50);
    }
    System.out.println(" ");
}
System.out.println(RESET+"makasih ya");









    }

    }



