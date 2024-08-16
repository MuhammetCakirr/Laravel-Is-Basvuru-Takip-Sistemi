
<h1>Proje Açıklaması</h1>
<p>Projede kullanıcılar iş ilanı oluşturabilir ve bu ilanlara başvurabilir. Kullanıcılar yeteneklerini kaydedebilir ve başvuru yaparken işin gerektirdiği yetenekleri, konumu ve çalışma şeklini belirtebilir. İş başvurusunun durumu, yalnızca iş sahibi tarafından değiştirilebilir ve bu durum politikalarla sağlanır. Bir kullanıcı bir işe başvurduğunda, hem başvurana hem de iş sahibine mailler gönderilir. Ayrıca, proje iş sahiplerinin başvurulara cevap vermediğini üç günde bir task scheduling ile kontrol eder ve cevap vermedikleri takdirde hatırlatma maili gönderir.</p> 

<h1>Kullandığım Teknolojiler</h1>
<ul>
    <li>Queue (Kuyruk): Arka planda yürütülmesi gereken işlemler için kuyruklar kullandım. Bu, özellikle yüksek hacimli e-posta gönderimleri veya uzun süren işlemler için önemliydi.</li>
    <li>Event (Olay): Sistemde meydana gelen belirli eylemleri tetiklemek için olaylar kullandım. Örneğin, 3 günde bir iş sahibine başvuranlara geri dönüş yapması için  hatırlatma maili gönderme işlemi.</li>
    <li>Listener (Dinleyici): Belirli olaylar meydana geldiğinde bu olaylara yanıt vermek için dinleyiciler kullandın. Örneğin, hatırlatma olayını dinleyerek e-posta gönderimini başlattım.</li>
    <li>Task Scheduling (Görev): Belirli görevlerin otomatik olarak yürütülmesini sağladım. Örneğin, iş sahiplerine düzenli hatırlatıcı e-postalar göndermek için bu özelliği kullandım. </li>
    <li>Trait (Özellik): Kod tekrarını azaltmak ve ortak işlevleri paylaşmak için özellikler kullandım.</li>
    <li>Observer (Gözlemci): Model değişikliklerini izlemek için gözlemciler kullandım. Bu, örneğin, bir iş başvurusunun statüsü güncellendiğinde ne zaman mülakata girilmiş, ne zaman reddedilmiş gibi bilgilere erişmemi sağladı.</li>
    <li>Policy (Politika): Kullanıcı izinlerini ve erişim kontrolünü yönetmek için politikalar kullandım. Bu, örneğin, sadece iş sahiplerinin başvuru durumunu değiştirebilmesini sağlamak için kullanıldı.</li>
    <li>Rule (Kural): Verilerin geçerliliğini kontrol etmek için özel kurallar tanımladım.</li>
    <li>Mail: Laravel’in mail sistemi ile iş başvurularının ve diğer önemli olayların ardından otomatik e-posta gönderimi sağladım.</li>
    <li>Resource (Kaynak): Verileri, özellikle API çıktılarında, daha düzenli ve özelleştirilebilir bir formatta sunmak için kaynaklar kullandım.</li>
    <li>Request (İstek): Giriş verilerinin doğrulaması ve işlenmesi için özel istek sınıfları kullandım.</li>
    <li>Sanctum: Login ve logout işlemleri için Sanctum’u kullanarak API güvenliğini sağladım. Bu, kullanıcıların güvenli bir şekilde kimlik doğrulaması yapmasını ve oturum açma/kapama işlemlerini gerçekleştirmesini mümkün kıldı.         Sanctum ile oluşturulan tokenlar sayesinde kullanıcıların API’ye erişimini güvenli bir şekilde yönettim.</li>
</ul>

<h1>Projede kod kalitesini ve stili yönetmek için</h1>
<ul>
    <li>Pint:Pint, kod formatını ve stilini belirli kurallara göre otomatik olarak düzeltti.</li>
    <li>Larastan: Kodlardaki potansiyel hataları bulmak ve tip güvenliğini artırmak için Larastan kullanarak, statik analizler gerçekleştirdim.</li>
</ul>

Bu şekilde, hem kullanıcı deneyimini hem de sistem verimliliğini artıran bir iş takip sistemi ortaya çıktı.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
