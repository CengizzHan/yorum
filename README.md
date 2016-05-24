#Yapılması Gerekenler 

 Uygulama'yı çalıştırabilmek için ilk olarak bilgisayarınızda Yii Advanced Sürümü ve Composer yüklü olması gerekmektedir. Yii kütüphanesi PHP üzerinde çalışan bir kütüphane olması nedeniyle bilgisayarınızda herhangi bir sanal sunucu uygulamasından yararlanabilirsiniz. Ben kendi uygulamamı geliştirirken XAMPP uygulamasından yardım alındı.
 
 
#Kopyalanacaklar ve Yapılacak cmd komutları
 1-Veri tabanına tabloların eklenebilmesi için yorum/Migrations Klasörünün altındaki iki dosyayı "C:\xampp\htdocs\advanced\console\migrations" Klasörü altında atmanız gerekmektedir.Kopyaladıktan sonra advanced dizisine gelerek 
 yii migrate cmd komutu ile gerekli veritabanlarının yüklenmesini sağlamalısınız.
 
 
 2-console/controllers altındak RbacController.php yi "C:\xampp\htdocs\advanced\console\controllers" dizine atmanız gerekmektedir.Common/rbac altındaki AuthorRule adlı php dosyasını "C:\xampp\htdocs\advanced\common\rbac" dizinine atmanız gerekmektedir.Eğer dizinler mevcut değilse lütfen oluşturunuz.
 
 
 3-Kopyalamaları gerçekleştirdikten sonra advanced/common/config/main.php dosyanı metin düzenleyici bir editor yardımıyla açarak.
 return [
    // ...
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        // ...
    ],
];
authmanager li kısmı components bölümüne ekleyiniz.


4-Cmd Ekranını açarak advanced dizinininde yii rbac/init ve ardından yii rbac/author-rule komutlarını çalıştırınız gerekli yetkilendirme hiyerarşisi kurulacaktır.(Eğer onceden DbManager ekli değilse yii migrate --migrationPath=@yii/rbac/migrations komutu ile aktif edilmesi gerekmektedir)

5-Yinin kurulu olduğu dizine gelerek composer.json guncellenmesi gerekmektedir.
.Composer.json..
...
"source": "https://github.com/yiisoft/yii2"
},
     "minimum-stability": "stable",
     "require": {
     "php": ">=5.4.0",
     "yiisoft/yii2": ">=2.0.6",
     "yiisoft/yii2-bootstrap": "",
     "yiisoft/yii2-swiftmailer": "",
     "cengizzhan/yorum": "dev-master" // Eklenen satır.
     },
     "require-dev": {
     "yiisoft/yii2-codeception": "*",


6-Yukarıdaki işlemi tamamladıktan sonra Yii uygulamamızın dosya sistemimize uygun olması için Yii dizini içerisinde bulunan Backend>Config>Main-local.php dosyasını herhangi bir metin editörü ile açınız.
.Main-local.php..
...
'modules'=>[
'yorum'=>[
'class' =>'cengizzhan\yorum\Yorum',
], 
],
...
...
şeklinde ekleyiniz.


7-frontend/controllers altindaki php dosyasını "C:\xampp\htdocs\advanced\frontend\controllers" dizinine kopyalayınız.frontend/yorum klasörünü  "C:\xampp\htdocs\advanced\frontend\views" altına kopyalayınız.Yapılan işlemler frontend tarafı içindi.


8-Tüm bu işlemler sonucunda uygulama kuruluma hazır hale gelecektir. Burdan sonra tek yapmanız gereken aşağıdaki kodlar yardımıyla kurulumu gerçekleştirmek ve sonuç kısmında belirtilen açıklamaları okumak.

Kurulum için Yii2.0'ın kurulu olduğu dizine komut satırında ulaşalım. Eğer daha önce kurulum yaptıksak önce composer clear-cache ile ön belleği temizleyelim. Eğer kurulum yapmadıysa veya ön bellek temizleme işlemini tamamladıysak composer update yardımıyla uygulama kurulumuna başlayabilirsiniz. Bu işlem 4-5 dakika sürmektedir.

#Sonuçlar
Proje içerisinde 2 tip kullanıcı mevcuttur:Admin ve Normal yazarlar(author)
Admin Her türlü yetkiye sahiptir.
Author Yorum ekleyebilir ve yalnızca kendi yapmış oldugu bir yorumu değiştirebilir.Kendi yorumunu silemez.
Author sadece tip ekleyebilir herhangi bir guncelleme veya silme işlemi yapamaz.
Eğer Tiplerde herhangi bir silme veya update işlemi gerçekleştirilirse aynı işlem yorumlardaki tipede uygulanır.Tip silinirse yorumda silinir


 
