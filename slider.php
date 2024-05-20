<style>
img{
    height: 400px !important;
    width: 700px !important ;
    overflow: hidden !important ;
}
</style>
<div class="container-fluid img-container">
    <div class="container CarouselNew " style="padding: 10px; ">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block img-fluid rounded" src="dimg/yemekler/20097250042944023274burger_hamburger_black_burger_juicy_116248_1920x1080.jpg" alt="">
                </div>
                <?php $slidersor = $db->prepare("SELECT * FROM slider order by slider_sira asc");
                $slidersor->execute();

                while ($slidercek = $slidersor->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="carousel-item">
                        <img class="d-block img-fluid  rounded" src="<?php echo $slidercek['slider_resimyol'] ?>" alt="">
                    </div>

                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Geri</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">İleri</span>
            </a>
        </div>
    </div>
</div>