<?php
namespace samsonframework\html2less;

/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 15.04.16 at 12:43
 */
class Tree
{
    /** @var array Collection of ignored DOM nodes */
    public static $ignoredNodes = array(
        'head',
        'meta',
        'script',
        'noscript',
        'link',
        'title',
        'br',
    );

    public function __construct()
    {
        $example = <<<'HTML'
        <html lang="en"><head>
<base href="/">
<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vfl0mFVOk/www-widgetapi.js" async=""></script><script type="text/javascript" async="" src="http://www.google-analytics.com/analytics.js"></script><script src="https://www.youtube.com/iframe_api"></script><script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-WWZ2DS"></script><script type="text/javascript">var __SAMSONPHP_STARTED = new Date().getTime();</script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
        <title>Pray for Ukraine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="google-site-verification" content="P7vIywlGAp7AXpXBP8mk3Q9s4QG0MSph3IoRzR9Yx4U">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!-- Latest 3.2.x goodshare.js minify version from jsDelivr CDN -->
        <script src="https://cdn.jsdelivr.net/jquery.goodshare.js/3.2.5/goodshare.min.js"></script>
        <link property="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,300italic,300,400italic&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link rel="alternate" lang="uk" href="http://prayforukraine.dev/ua/"><link rel="alternate" lang="ru" href="http://prayforukraine.dev/ru/http://prayforukraine.dev/ua/">
<link type="text/css" rel="stylesheet" href="/cache/resourcer/default/bb5d08be43e350c3df6dbd4cd7f81e97.css">
</head>

    <body id="main">
        <section class="header">
            <h6 hidden="">Header</h6>
            <div class="inner-section">
                <a class="logo-img" href="http://prayforukraine.dev"></a>
                <a class="logo-word" href="http://prayforukraine.dev"></a>

                <div class="close menu-open"></div>
                <nav class="menu">
                    <div class="locale">
                        <!-- i18n Locale selection block Created by Vitaly Iegorov <egorov@samsonos.com> on 07.03.14 at 12:03 start -->
<div class="i18n-current" style="display: none;">
    en</div>
<ul class="i18n-list">
    <li class="i18n-locale-en i18n-active">
    <a href="http://prayforukraine.dev/"></a>
</li><li class="i18n-locale-ua ">
    <a href="http://prayforukraine.dev/ua/"></a>
</li><li class="i18n-locale-ru ">
    <a href="http://prayforukraine.dev/ru/"></a>
</li></ul>
<!-- i18n Locale selection block Created by Vitaly Iegorov <egorov@samsonos.com> on 07.03.14 at 12:03 end -->                    </div>
                    <a class="menu-text" id="projects-link" href="http://prayforukraine.dev/projects/">projects</a>
                    <a class="menu-text" id="news-link" href="http://prayforukraine.dev/news/">news</a>
                    <a class="menu-text" id="team-link" href="http://prayforukraine.dev/team/">our team</a>
                    <div class="button orange open-popup">Donate</div>
                </nav>
            </div>
        </section>

        <!-- PAGE BLOCK -->
<section class="page main-page" style="background-image: url(/view/?p=/src/main/www/img/page.png)">
    <h6 class="big-text">
        DONATE<br>SAVE LIVES TOGETHER    </h6>
    <div class="center">
        <div class="button orange scroll-button">
            Donate now        </div>
    </div>
</section>

<div class="video-color">
    <section class="video">
        <h6 hidden="">Video</h6>
        <div class="image"></div>
                    <div class="center">
                <div class="center-video-button"></div>
                <iframe class="video-youtube" id="YVjPznbAtmA" frameborder="0" allowfullscreen="1" title="YouTube video player" width="638" height="355" src="https://www.youtube.com/embed/YVjPznbAtmA?rel=0&amp;autohide=1&amp;controls=0&amp;showinfo=0&amp;enablejsapi=1&amp;origin=http%3A%2F%2Fprayforukraine.dev"></iframe>
            </div>
            </section>
</div>

<!-- PROJECTS BLOCK -->
у
<section class="projects">
    <div class="inner-section">
        <div class="list-projects">
    <div class="swiper-button-prev swiper-button-prev-projects swiper-button-disabled"></div>
    <div class="swiper-container swiper-container-horizontal swiper-projects">
        <div class="swiper-wrapper">
            <div onclick="location.href='http://prayforukraine.dev/projects/projects-29/'" class="one-project swiper-slide swiper-slide-active">
    <div class="photo" style="background-image: url('')"></div>
    <div class="description">
        <div class="title">
            Test        </div>
        <div class="text">
            Test info        </div>
    </div>
            <div class="center">
            <a onclick="location.href='http://prayforukraine.dev/projects/projects-29/'" class="button white">learn more</a>
        </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/portable-medical-equipment/'" class="one-project swiper-slide swiper-slide-next">
    <div class="photo" style="background-image: url('/upload/2cc3b934e2015910bc152b10341af8f7.jpg')"></div>
    <div class="description">
        <div class="title">
            PORTABLE MEDICAL EQUIPMENT        </div>
        <div class="text">
            Pray for Ukraine collects donations to provide necessary items such as military equipment and medicines. Military special forces in the Eastern region of Ukraine continue to carry out its primary duty - to protect especially important sites covering the state border and protect the civilian population.         </div>
    </div>
            <div class="center">
            <a onclick="location.href='http://prayforukraine.dev/projects/portable-medical-equipment/'" class="button white">learn more</a>
        </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/firstaidkit/'" class="one-project swiper-slide">
    <div class="photo" style="background-image: url('/upload/5472d2827386fb3a3d834708209390a6.jpeg')"></div>
    <div class="description">
        <div class="title">
            Individual First Aid Kit        </div>
        <div class="text">
            The Individual First Aid Kit, or IFAK, gives a soldier the ability to administer Self-Aid/Buddy-Aid and provides a path for intervention of two leading causes of death on the battlefield, severe hemorrhaging and blocked airways        </div>
    </div>
            <div class="center">
            <a onclick="location.href='http://prayforukraine.dev/projects/firstaidkit/'" class="button white">learn more</a>
        </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/shelter-chervonoarmiysk/'" class="one-project swiper-slide">
    <div class="photo" style="background-image: url('/upload/5c5ebda197c9c53ab9272d33ab5eeb6c.jpg')"></div>
    <div class="description">
        <div class="title">
            Help shelter for child victims of war        </div>
        <div class="text">
            Shelter Chervonoarmiysk is for 30 children who lost their parents because of the war. A few miles from their destroyed homes        </div>
    </div>
            <div class="center">
            <a onclick="location.href='http://prayforukraine.dev/projects/shelter-chervonoarmiysk/'" class="button white">learn more</a>
        </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/help-disabled-children-veronika/'" class="one-project swiper-slide">
    <div class="photo" style="background-image: url('/upload/337a7990213c708c97216461ecfa443a.png')"></div>
    <div class="description">
        <div class="title">
            Help Veronika to live, 3 years, bone marrow cancer        </div>
        <div class="text">
            Help Veronika to live, 3 years, bone marrow cancer        </div>
    </div>
            <div class="center">
            <a onclick="location.href='http://prayforukraine.dev/projects/help-disabled-children-veronika/'" class="button white">learn more</a>
        </div>
    </div>        </div>
    </div>
    <div class="swiper-button-next swiper-button-next-projects"></div>
</div>    </div>
</section>
<!-- TEAM BLOCK -->
<section class="team">
    <div class="inner-section">
        <div class="header-text">Our team</div>
        <div class="all-people">
    <div class="one">
    <a class="photo" href="http://prayforukraine.dev/team/yaroslav-kandyba/" style="background-image: url('/upload/bb3a1d725df000114e85470a2253cddb.png')"></a>
    <a class="social" href="https://www.facebook.com/profile.php?id=100011337422732&amp;fref=ts"></a>
    <div class="description">
        <div class="name">
            Yaroslav Kandyba        </div>
        <div class="text">
            <p>Yaroslav is founder of Pray for Ukraine foundation. He helps children who became victims of war, who lost their parents. From age of 4 to 18 they got serious problems with health, they don't have place where to live, nothing to eat and to wear. Also Yaroslav collects aid for people who needs immediately medical help. Also soldier collects aid for army needs such as warm clothing, uniforms, first aid kits.</p><p></p>        </div>
                    <a href="http://prayforukraine.dev/team/yaroslav-kandyba/ " class="more-info">More</a>
            </div>
</div><div class="one">
    <a class="photo" href="http://prayforukraine.dev/team/yurii-bodnar/" style="background-image: url('/upload/99ee88634efc76d33d9e2a1d6c7b802a.jpg')"></a>
    <a class="social" href="https://www.facebook.com/profile.php?id=100007071728288&amp;sk=photos"></a>
    <div class="description">
        <div class="name">
            Yurii Bodnar        </div>
        <div class="text">







<p class="p1"><span class="s1" style="font-size: 14px; font-family: Arial;">Yurii has been being volunteer and soldier in Ukraine army for the 2nd year. His dangerous profession became his way of life. Every day Yurii helps to survive his colleagues. He collects aid for the most necessary things military - equipment for the conduct of defense and medical suppliements. </span></p>        </div>
                    <a href="http://prayforukraine.dev/team/yurii-bodnar/ " class="more-info">More</a>
            </div>
</div><div class="one">
    <a class="photo" href="http://prayforukraine.dev/team/taras-chmut/" style="background-image: url('/upload/7fdff13b16a629da550c0abd009b0db4.jpg')"></a>
    <a class="social" href="https://www.facebook.com/profile.php?id=100003822077764&amp;fref=ts"></a>
    <div class="description">
        <div class="name">
            Taras Chmut        </div>
        <div class="text">
            Taras is only 24, but he can already proud about himself. He works volunteer and soldier in <span style="font-family: Arial; font-size: 14px;">the Naval Forces of Ukraine. He decided that he could not stay apart when his country is in danger. Taras decided to work in ukrainian navy because there are soldiers who are worth to be like them. Taras knew from childhood that only strong men work in naval forces. besides, there are many problem in ukrainian navy. First of all the lack of equipment for protection against attacks of the occupier. </span>        </div>
                    <a href="http://prayforukraine.dev/team/taras-chmut/ " class="more-info">More</a>
            </div>
</div><div class="one">
    <a class="photo" href="http://prayforukraine.dev/team/ihor-fedirko/" style="background-image: url('/upload/4d6604dc9ccf08773582c03df09dc811.jpg')"></a>
    <a class="social" href="https://www.facebook.com/igor.fedirko?fref=ts"></a>
    <div class="description">
        <div class="name">
            Ihor Fedirko        </div>
        <div class="text">







<p class="p1"><span style="font-family: Arial;"><span class="s1" style="font-size: 14px;">Ihor works as a volunteer in </span><span class="s2"><span style="font-size: 14px;">3-rd and 8-th individual regiments of the Main Intelligence Directorate of the Ministry of Defence of Ukraine and 73-th and 140-th Centers for Special Purposes. The situation in battalions is extremely dangerous - warm clothes and medicines are running out. Soldiers of groups can not organize a high-quality surveillance of enemy equipment because of lack of modern equipment. Ihor helps his colleagues to collect money to buy all the necessary equipment.</span><span style="font-size: 14px;"> </span></span></span></p>        </div>
                    <a href="http://prayforukraine.dev/team/ihor-fedirko/ " class="more-info">More</a>
            </div>
</div></div>        <div class="header-text last">
            OUR CURRENT FUNDRAISING PROJECTS AND APPEALS        </div>
    </div>
</section>
<!-- PROJECTS BLOCK -->
<section class="projects all-more">
    <div class="inner-section">
        <div class="list-projects">
    <div class="swiper-button-prev swiper-button-prev-specific swiper-button-disabled"></div>
    <div class="swiper-container swiper-container-horizontal swiper-specific">
        <div class="swiper-wrapper">
            <div onclick="location.href='http://prayforukraine.dev/projects/projects-29/'" class="one-project swiper-slide swiper-slide-active" style="width: 235px;">
    <div class="photo" style="background-image: url('')"></div>
    <div class="description">
        <div class="title">
            Test        </div>
        <div class="text">
            Test info        </div>
    </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/portable-medical-equipment/'" class="one-project swiper-slide swiper-slide-next" style="width: 235px;">
    <div class="photo" style="background-image: url('/upload/2cc3b934e2015910bc152b10341af8f7.jpg')"></div>
    <div class="description">
        <div class="title">
            PORTABLE MEDICAL EQUIPMENT        </div>
        <div class="text">
            Pray for Ukraine collects donations to provide necessary items such as military equipment and medicines. Military special forces in the Eastern region of Ukraine continue to carry out its primary duty - to protect especially important sites covering the state border and protect the civilian population.         </div>
    </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/firstaidkit/'" class="one-project swiper-slide" style="width: 235px;">
    <div class="photo" style="background-image: url('/upload/5472d2827386fb3a3d834708209390a6.jpeg')"></div>
    <div class="description">
        <div class="title">
            Individual First Aid Kit        </div>
        <div class="text">
            The Individual First Aid Kit, or IFAK, gives a soldier the ability to administer Self-Aid/Buddy-Aid and provides a path for intervention of two leading causes of death on the battlefield, severe hemorrhaging and blocked airways        </div>
    </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/shelter-chervonoarmiysk/'" class="one-project swiper-slide" style="width: 235px;">
    <div class="photo" style="background-image: url('/upload/5c5ebda197c9c53ab9272d33ab5eeb6c.jpg')"></div>
    <div class="description">
        <div class="title">
            Help shelter for child victims of war        </div>
        <div class="text">
            Shelter Chervonoarmiysk is for 30 children who lost their parents because of the war. A few miles from their destroyed homes        </div>
    </div>
    </div><div onclick="location.href='http://prayforukraine.dev/projects/help-disabled-children-veronika/'" class="one-project swiper-slide" style="width: 235px;">
    <div class="photo" style="background-image: url('/upload/337a7990213c708c97216461ecfa443a.png')"></div>
    <div class="description">
        <div class="title">
            Help Veronika to live, 3 years, bone marrow cancer        </div>
        <div class="text">
            Help Veronika to live, 3 years, bone marrow cancer        </div>
    </div>
    </div>        </div>
    </div>
    <div class="swiper-button-next swiper-button-next-specific"></div>
</div>        <div class="center">
            <a class="button white" href="http://prayforukraine.dev/projects/">learn more</a>
        </div>
    </div>
</section>        <!-- FOOTER SECTION -->
        <div id="popup-message">
    <div class="popup-close"></div>
    <div class="text"></div>
</div>

<div id="footer-message">
    <div class="popup-close"></div>
    <div class="text"></div>
</div>

<section class="footer">
    <div class="email-block">
        <h6>
            TOGETHER WE CAN MAKE A DIFFERENCE        </h6>
        <div class="select-phone">
    <select class="select">
        <option value="1">$1</option>
        <option value="5">$5</option>
        <!--        <option value="10">$10</option>-->
        <option value="20">$20</option>
        <option value="50">$50</option>
        <option value="100">$100</option>
        <option value="500">$500</option>
    </select>
</div>
<div class="select-money">
    <div class="one active" data-value="1">$1</div>
    <div class="one" data-value="5">$5</div>
    <!--    <div class="one" data-value="10">$10</div>-->
    <div class="one" data-value="20">$20</div>
    <div class="one" data-value="50">$50</div>
    <div class="one" data-value="100">$100</div>
    <div class="one" data-value="500">$500</div>
</div>        <input type="text" id="footer-input" placeholder="Or enter donation value">
        <div class="over-payment">
            <div class="info-payment">

                <div class="info-donator">
                    <input type="email" class="gray donator-input" id="footer-donator-email-input" name="email-donator" placeholder="Input your e-mail"><br>
                    <input type="text" class="gray donator-input" id="footer-donator-input" name="name-donator" placeholder="Input your name">
                </div>

                <!--                <div class="payment-header">-->
                <!--</div>-->
                <div class="lists-bank">
                    <div class="phone swiper-button-prev swiper-button-prev-footer"></div>
                    <div class="swiper-container swiper-footer">
                        <div class="swiper-wrapper">
    <div class="one">
    <!--    <div class="up-bank hidden"></div>-->
    <div class="lightpay"></div>
</div></div>                    </div>
                    <div class="phone swiper-button-next swiper-button-next-footer"></div>
                </div>
            </div>
        </div>

        <div class="buttons">
            <div class="button blue">single donation</div>
            <div class="button">give monthly</div>
        </div>

        <div class="share-hidden">
            <div class="share">
                <div class="share-header">
                    Share with your friends                </div>

                <div class="all-share">
                    <a class="goodshare one-share fb" data-type="fb" href="#"></a>
                    <a class="goodshare one-share tw" data-type="tw" href="#"></a>
                    <a class="goodshare one-share gp" data-type="gp" href="#"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="info-block">
        <h5 class="info-header">
            HELP US TO SAVE UKRAINIAN LIVES        </h5>
        <div class="under-header">
            why Ukraine?        </div>

        <div class="inner-section">
    <div class="informations">
        <div class="one-info">
    <div class="numbers">
        18 000    </div>
    <div class="description">
        <p>people have died</p><p> in undeclared war</p>    </div>
</div>
&nbsp;<div class="one-info">
    <div class="numbers">
        1 200    </div>
    <div class="description">
        <p>among them</p><p>children</p>    </div>
</div>
&nbsp;<div class="one-info">
    <div class="numbers">
        30 290    </div>
    <div class="description">
        <div>injured and</div><div>hospitalized</div>    </div>
</div>
&nbsp;<div class="one-info">
    <div class="numbers">
        118 000    </div>
    <div class="description">
        <div>Children left</div><div>orphans and</div><div>disabled</div>    </div>
</div>
&nbsp;<div class="one-info">
    <div class="numbers">
        2 638 000    </div>
    <div class="description">
        <p>people were forced</p><p> to leave </p><p>their homes<br></p>    </div>
</div>
&nbsp;    </div>
</div>
        <div class="big-text">
            TOGETHER WE CAN MAKE A DIFFERENCE        </div>

        <div class="button orange scroll-button">
            Donate now        </div>

        <div class="share">
            <div class="share-header">
                Share with your friends            </div>
            <div class="all-share">
                <a class="one-share fb" href="https://www.facebook.com/prayforukraine.org.ua"></a>
                <a class="one-share tw" href="https://twitter.com/"></a>
                <a class="one-share gp" href="https://plus.google.com/"></a>
            </div>
        </div>
    </div>
</section>
        <!-- POPUP SECTION -->
        <div class="all-page"></div>

<section class="popup" id="popup">
    <h6 hidden="">Popup</h6>
    <div class="email-block">

        <div class="popup-header">
            DONATE            <div class="close-popup"></div>
        </div>

        <div class="select-phone">
    <select class="select">
        <option value="1">$1</option>
        <option value="5">$5</option>
        <!--        <option value="10">$10</option>-->
        <option value="20">$20</option>
        <option value="50">$50</option>
        <option value="100">$100</option>
        <option value="500">$500</option>
    </select>
</div>
<div class="select-money">
    <div class="one active" data-value="1">$1</div>
    <div class="one" data-value="5">$5</div>
    <!--    <div class="one" data-value="10">$10</div>-->
    <div class="one" data-value="20">$20</div>
    <div class="one" data-value="50">$50</div>
    <div class="one" data-value="100">$100</div>
    <div class="one" data-value="500">$500</div>
</div>
        <input type="text" id="popup-input" placeholder="Or enter donation value">

        <div class="over-payment">
            <div class="info-payment">

                <div class="info-donator">
                    <input type="email" class="gray donator-input" id="popup-donator-email-input" name="email-donator" placeholder="Input your e-mail"><br>
                    <input type="text" class="gray donator-input" id="popup-donator-input" placeholder="Input your name" name="name-donator">
                </div>

                <!--                <div class="payment-header">-->
                <!--</div>-->
                <div class="lists-bank">
                    <div class="phone swiper-button-prev swiper-button-prev-popup"></div>
                    <div class="swiper-container swiper-popup">
                        <div class="swiper-wrapper">
    <div class="one">
    <!--    <div class="up-bank hidden"></div>-->
    <div class="lightpay"></div>
</div></div>                    </div>
                    <div class="phone swiper-button-next swiper-button-next-popup"></div>
                </div>
            </div>
        </div>

        <div class="buttons">
            <div class="button blue">single donation</div>
            <div class="button">give monthly</div>
        </div>

        <div class="share-hidden">
            <div class="popup-thanks"></div>
            <div class="share">
                <div class="share-header">
                    Share with your friends                </div>

                <div class="all-share">
                    <a class="goodshare one-share fb" data-type="fb" href="#"></a>
                    <a class="goodshare one-share tw" data-type="tw" href="#"></a>
                    <a class="goodshare one-share gp" data-type="gp" href="#"></a>
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="popup" id="popup-thanks-payment">
            <div class="email-block">
                <div class="popup-header">
                    Thank you for your donation!
                    <div class="close-popup"></div>
                </div>

                <div class="share-hidden" style="display: block;">
                    <div class="share">
                        <div class="share-header">
                            Share with your friends
                        </div>
                        <div class="all-share">
                            <a class="goodshare one-share fb" data-type="fb" href="#"></a>
                            <a class="goodshare one-share tw" data-type="tw" href="#"></a>
                            <a class="goodshare one-share gp" data-type="gp" href="#"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Tag Manager -->
        <noscript>&lt;iframe src="//www.googletagmanager.com/ns.html?id=GTM-WWZ2DS"
                          height="0" width="0" style="display:none;visibility:hidden"&gt;&lt;/iframe&gt;</noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WWZ2DS');</script>
        <!-- End Google Tag Manager -->

<script type="text/javascript" src="/cache/resourcer/default/52f7a218fc1ffe5f12080fd5a664c7f5.js"></script><div class="__loader_bg" style="display: none;"><div class="__loader_middle"><div id="canvas-loader_2170" class="__loader_canvas"><div id="canvasLoader" style="display: block;"><canvas width="72" height="72"></canvas><canvas width="72" height="72" style="display: none;"></canvas></div></div><div class="text"></div></div></div>

</body></html>
HTML;
        trace($this->build($example), 1);
    }

    /**
     * Build destination code tree from source code.
     *
     * @param string $source Source code
     */
    public function build($source)
    {
        // Prepare source code
        $source = $this->prepare($source);

        // Build destination node tree
        $tree = $this->analyze($source);

        return $this->output($tree, $output);
    }

    /**
     * Source code cleaner.
     *
     * @param string $source
     *
     * @return string Cleared source code
     */
    protected function prepare($source)
    {
        // Remove all PHP code from view
        return trim(preg_replace('/<\?(php|=).*?\?>/', '', $source));
    }

    /**
     * Analyze source code and create destination code tree.
     *
     * @param string $source Source code
     *
     * @return HTMLDOMNode Internal code tree
     */
    protected function &analyze($source)
    {
        libxml_use_internal_errors(true);

        /** @var \DOMNode Pointer to current dom element */
        $dom = new \DOMDocument();
        $dom->loadHTML($source);

        // Perform recursive node analysis
        return $this->analyzeSourceNode($dom, new HTMLDOMNode(new \DOMNode()));
    }

    /**
     * Perform source node analysis.
     *
     * @param \DOMNode    $domNode
     * @param HTMLDOMNode $parent
     *
     * @return HTMLDOMNode
     */
    protected function &analyzeSourceNode(\DOMNode $domNode, HTMLDOMNode $parent)
    {
        /** @var \DOMNode[] $children */
        $children = [];
        /** @var array $tags tag name => count collection */
        $tags = [];

        foreach ($domNode->childNodes as $child) {
            $tag = $child->nodeName;

            // Work only with allowed DOMElements
            if ($child->nodeType === 1 && !in_array($tag, static::$ignoredNodes)) {
                $children[] = $child;

                // Get child node tag and count them
                if (!array_key_exists($tag, $tags)) {
                    $tags[$tag] = 1;
                } else {
                    $tags[$tag]++;
                }
            }
        }

        // Iterate all normal DOM nodes
        foreach ($children as $child) {
            // Create internal node instance
            $node = new HTMLDOMNode($child, $parent);

            // Go deeper in recursion
            $this->analyzeSourceNode($child, $node);
        }

        return $parent;
    }

    /**
     * @param HTMLDOMNode $node
     * @param string      $output
     * @param int         $level
     *
     * @return string
     */
    public function output(HTMLDOMNode $node, &$output = '', $level = 0)
    {
        // Generate tabs array
        $output .= implode('', array_fill(0, $level, '  ')) . $node . "\n";

        foreach ($node->children as $child) {
            $this->output($child, $output, $level + 1);
        }

        return $output;
    }

    /**
     * Handle current DOM node and transform it to LESS node
     *
     * @param \DOMNode $node Pointer to current analyzed DOM node
     * @param array    $path
     *
     * @internal param \samsonos\php\skeleton\Node $parent Pointer to parent LESS Node
     */
    protected function handleNode(\DOMNode & $node, &$path = array())
    {
        // Collect normal HTML DOM nodes
        /** @var \DOMNode[] $children */
        $children = array();
        foreach ($node->childNodes as $child) {
            // Work only with DOMElements
            if ($child->nodeType == 1) {
                $children[] = $child;
            }
        }
        // Group current level HTML DOM nodes by tag name and count them
        $childrenTagArray = array();
        foreach ($children as $child) {
            $tag = $child->nodeName;
            if (!isset($childrenTagArray[$tag])) {
                $childrenTagArray[$tag] = 1;
            } else $childrenTagArray[$tag]++;
        }
        // Iterate all normal DOM nodes
        foreach ($children as $child) {
            // Create LESS node
            $childNode = new HTMLDOMNode($child);
            // If this LESS node has NO CSS classes
            if (sizeof($childNode->class) == 0) {
                // Create new multidimensional array key group
                if (!isset($path[$child->nodeName])) {
                    $path[$child->nodeName] = array();
                }
                // Go deeper in recursion with current child node and new path
                $this->handleNode($child, $path[$child->nodeName]);
            } else { // This child DOM node has CSS classes
                // Get first node class and remove it from array og classes
                $firstClass = array_shift($childNode->class);
                // Save current LESS path
                $oldPath = &$path;
                // If there is more than one DOM child node with this tag name at this level
                if ($childrenTagArray[$childNode->tag] > 1 && $childNode->tag != 'div') {
                    // Create correct LESS class name
                    $class = '&.' . $firstClass;
                    // Create new multidimensional array key group with tag name group
                    if (!isset($path[$child->nodeName][$class])) {
                        $path[$child->nodeName][$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with tag name group and CSS class name group
                    $this->handleNode($child, $path[$child->nodeName][$class]);
                    // Make new path as current
                    $path = &$path[$child->nodeName][$class];
                } else { // There is only on child with this tag name at this level
                    // Create correct LESS class name
                    $class = '.' . $firstClass;
                    // Create new multidimensional array key group without tag name group
                    if (!isset($path[$class])) {
                        $path[$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with CSS class name group
                    $this->handleNode($child, $path[$class]);
                    // Make new path as current
                    $path = &$path[$class];
                }
                // Iterate all other classes starting from second class
                foreach ($childNode->class as $class) {
                    // Create correct LESS class name
                    $class = '&.' . $class;
                    // Create new multidimensional array key group with tag name group
                    if (!isset($path[$class])) {
                        $path[$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with tag name group and CSS class name group
                    $this->handleNode($child, $path[$class]);
                }
                // Return old LESS path tree
                $path = &$oldPath;
            }
        }
    }
}
