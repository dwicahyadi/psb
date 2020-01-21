##Install Guide
<ol>
    <li>download atau clone sourcecode lalu extract</li>
    <li>buat database baru</li>
    <li>rename file <code>.env.example</code> menjadi <code>.env</code></li>
    <li>
        edit file <code>.env</code> lalu sesuaikan pengaturan database
        <p>DB_DATABASE=nama-database</p>
           <p>DB_USERNAME=user</p>
           <p>DB_PASSWORD=passwordnya</p> 
    </li>
    <li>buka terminal/command prompt lalu ketik perintah berikut secara berurutan
    <p><code>composer update</code></p>
    <p><code>php artisan key:generate</code></p>
    <p><code>php artisan migrate</code></p>
    <p><code>php artisan db:seed</code></p>
    </li>
    <li>Untuk menjalankan, jalankan perintah <code>php artisan serve</code>. Buka browser lalu masukan url http://localhost:8000</li>
</ol>
