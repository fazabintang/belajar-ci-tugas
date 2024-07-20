<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect_filter
{
    // Fungsi untuk melakukan redirect setelah login
    public function redirect_after_login()
    {
        // Periksa apakah user baru saja login
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['password'])) {
            // Lakukan validasi login, misalnya dengan memeriksa username dan password yang sesuai
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Contoh validasi sederhana, gantilah dengan validasi yang sesuai dengan kebutuhan Anda
            if ($username === 'username' && $password === 'password') {
                // Jika login berhasil, arahkan pengguna ke halaman FAQ
                redirect('faq'); // Sesuaikan dengan nama route atau URL halaman FAQ Anda
            }
        }
    }
}
?>
