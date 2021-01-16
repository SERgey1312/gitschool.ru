<footer class="footer_container">
    <!---->
    <div  class="for_alfa_bank">
        <div class="payment_systems">
            <p>Мы принимаем к оплате:</p>
            <div class="pay_images_container">
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/visa.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/visa-secure.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/alfa-bank.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/mc_id.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/Samsung.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/mc.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/bel_card.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/belkart_internetparol.png' ?>" alt=""></div>
                <div class="pay_img_container"><img src="<?php echo get_template_directory_uri() . '/assets/img/Alfa_Bank/Apple.png' ?>" alt=""></div>
            </div>
            <div style="margin: 15px 0 0 0">
                <p><a href="<?php echo  get_page_uri(get_page_by_path('confidencialnost_git')->ID);?>">Политика конфиденциальности</a></p>
                <p><a href="<?php echo  get_page_uri(get_page_by_path('oferta')->ID);?>">Договор Оферты</a></p>
            </div>
        </div>
        <div class="contact_info" >
            <p style="font-size: 12px">OOO "Гит скул айти" <br> УНП 193485947 <br> 220057, Республика Беларусь, Минск, ул. Фогиля, 7 пом. 213а <br>
                Свидетельство о государственной регистрации № 193485947 от 03.11.2020 выдано Минским
                горисполкомом <br>
                Тел: +375445540088<br>
                Email: info.git.school@gmail.com
            </p>
        </div>
    </div>
    <!---->
</footer>
<!--/footer-->

<?php wp_footer(); ?>
<script>
    new WOW().init();
</script>
</body>

</html>