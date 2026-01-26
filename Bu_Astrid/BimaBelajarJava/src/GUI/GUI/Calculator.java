package GUI;


    import javax.swing.*;
    import java.awt.*;
    import java.awt.event.ActionEvent;
    import java.awt.event.ActionListener;
    
    public class Calculator extends JFrame {
        private JTextField display; // Komponen untuk menampilkan angka dan hasil
        private double num1, num2, result;
        private String operator;
    
        public Calculator() {
            // Atur judul kalkulator
            setTitle("Calculator");
            setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            setSize(400, 500);
            setLayout(new BorderLayout());
    
            // Panel display (bagian atas)
            display = new JTextField();
            display.setFont(new Font("Arial", Font.BOLD, 24));
            display.setHorizontalAlignment(SwingConstants.RIGHT);
            display.setEditable(false);
            add(display, BorderLayout.NORTH);
    
            // Panel tombol (bagian tengah)
            JPanel buttonPanel = new JPanel();
            buttonPanel.setLayout(new GridLayout(4, 4, 10, 10));
    
            // Tombol angka dan operator
            String[] buttons = {
                    "7", "8", "9", "+",
                    "4", "5", "6", "-",
                    "1", "2", "3", "*",
                    "C", "0", "=", "/"
            };
    
            // Tambahkan tombol ke panel
            for (String text : buttons) {
                JButton button = new JButton(text);
                button.setFont(new Font("Arial", Font.BOLD, 20));
                buttonPanel.add(button);
    
                // Tambahkan event listener
                button.addActionListener(new ButtonClickListener());
            }
    
            add(buttonPanel, BorderLayout.CENTER);
    
            // Atur posisi frame di tengah layar
            setLocationRelativeTo(null);
        }
    
        // Event listener untuk tombol
        private class ButtonClickListener implements ActionListener {
            @Override
            public void actionPerformed(ActionEvent e) {
                String command = ((JButton) e.getSource()).getText();
    
                if ("0123456789".contains(command)) { // Jika tombol angka ditekan
                    display.setText(display.getText() + command);
                } else if ("+-*/".contains(command)) { // Jika tombol operator ditekan
                    num1 = Double.parseDouble(display.getText());
                    operator = command;
                    display.setText("");
                } else if (command.equals("=")) { // Jika tombol = ditekan
                    num2 = Double.parseDouble(display.getText());
                    switch (operator) {
                        case "+":
                            result = num1 + num2;
                            break;
                        case "-":
                            result = num1 - num2;
                            break;
                        case "*":
                            result = num1 * num2;
                            break;
                        case "/":
                            if (num2 != 0) {
                                result = num1 / num2;
                            } else {
                                display.setText("Error");
                                return;
                            }
                            break;
                    }
                    display.setText(String.valueOf(result));
                } else if (command.equals("C")) { // Jika tombol Clear ditekan
                    display.setText("");
                    num1 = num2 = result = 0;
                    operator = "";
                }
            }
        }
    
        public static void main(String[] args) {
            SwingUtilities.invokeLater(() -> {
                new Calculator().setVisible(true);
            });
        }
    }

