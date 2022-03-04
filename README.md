# basket-application-case-projets

Docker ayağa kaldırınız.

- docker-compose up -d --buil

- docker exec -it basket_php bash
    
Container bağlandıktan sonra 

Composer yüklü değilse composer paket yükleyicisini yükleyiniz.
    
- composer install

webpackmix ile tasarım mixlenmiştir. Bundan dolayı npm paket yükleyicisi kullanılmalıdır. Aksi takdirde dosyaları public dosyasına çekilmelidir.

Npm yüklü değilse npm paket yükleyicisini yükleyiniz.
   
- npm install
    
- npm run dev
    
- env dosyasını düzenleyiniz.
    
DB_HOST=basket_mysql
DB_PORT=3306
DB_DATABASE=basket_db
DB_USERNAME=basket_user
DB_PASSWORD=basket_password
    
- php artisa migrate:fresh --seed
    
Projede sepete ürün eklenip çıkarılıyor. Sepet sayfasında ürün adet güncelleyebilirsiniz.

Ürün eklenirken stok adeti yeterli değilse ürün ekleme işlemi gerçekleşmez.
    
Sepetteki ürün adeti güncellenirken stok adeti yeterli değilse güncelleme işlemi gerçekleştirilmez.

Sepetimden ürünleri çıkarabilirsiniz.
    
Ürün toplam ve Karegori id 1 ve 2 olan ürünler istenilen indirim uygulanmıştır.

Siparişi tamamla  butonuna tıklayarak ürünleri siparişler tablosuna eklenir, sepetimdeki tüm ürünler silinir ve ürünler tablosudan stok güncellenir.

Sipariş sayfasında ürünleri siparişlerimden çıkarabilirsiniz.
    
    

