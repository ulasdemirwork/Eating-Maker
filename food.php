<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .cooklist a {
        color: black;
    }

    .cooklist a:hover {
        color: red;
    }

    .jumbotron {
        background: transparent;
        color: red;
        font-weight: bold;
        font-size: 24px;
    }

    .jumbotron h1,
    h5,
    p {

        font-weight: bold;
        text-align: center;

    }

    .jumbotron {
        position: relative;
        overflow: hidden;
    }

    .jumbotron .container {
        position: relative;
        z-index: 2;

        background: rgba(0, 0, 0, 0.2);
        padding: 2rem;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }

    .jumbotron-background {
        object-fit: cover;
        font-family: 'object-fit: cover;';
        position: absolute;
        top: 0;
        z-index: 1;
        width: 100%;
        height: 100%;
        opacity: 0.5;
    }

    img.blur {
        -webkit-filter: blur(4px);
        filter: blur(4px);
        filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius='4');
    }

    /* Voting start */
    .likebtn,
    .dislikebtn {
        color: #fff;
        background: none;
        border: none;
        font-size: 20px;
        padding: 0 15px;
        margin: 10px 0;
        margin-left: 20px;
        cursor: pointer;
    }

    /* Voting End  */
</style>
<div>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="navbar-nav mx-auto pl-4  cooklist">
            <a class="nav-item nav-link active" href="#">Sıcak Yemekler</a>
            <hr>
            <a class="nav-item nav-link" href="#">Soğuk Yemekler </a>
            <hr>
            <a class="nav-item nav-link" href="#">Yöresel Yemekler </a>
            <hr>
            <a class="nav-item nav-link " href="#">Soğuk Tatlılar </a>
            <hr>
            <a class="nav-item nav-link" href="#">Sıcak Tatlılar </a>
            <hr>
            <a class="nav-item nav-link" href="#">Kızartmalık</a>
            <hr>
        </div>
    </nav>

    <div class="container-fluid background blur p-0 m-0">
        <div class="jumbotron jumbotron-fluid bg-dark">
            <div class="jumbotron-background">
                <img src="images/adana2.jpg" class="blur">
            </div>

            <div class="container text-white">

                <h1 class="display-4">Adana Kebabı</h1>
                <img src="images/adana2.jpg" class="img-fluid">
                <p class="lead">Adana kebabı adanaya iliyle meşhurdur adana iline özeldir</p>
                <hr class="my-4">
                <p class="h5">adana kebabı hakkında daha fazla bilgi edinmek için <a href="recipe.php"><button class="btn btn-outline-success btn-sm">Tıklayınız</button></a> <button class="likebtn" id="likebtn">
                        <i class="fa fa-thumbs-up"></i>
                    </button>
                    <button class="dislikebtn" id="dislikebtn">
                        <i class="fa fa-thumbs-down"></i>
                    </button>
                </p>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.jumbotron -->

    <div class=" jumbotron jumbotron-fluid bg-dark">
        <div class="jumbotron-background">
            <img src="images/resim2.jpg" class="blur">
        </div>

        <div class="container text-white">

            <h1 class="display-4">Tokat sarması</h1>
            <img src="images/resim2.jpg" class="img-fluid">
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam deserunt rem dolor reprehenderit reiciendis officia eveniet suscipit, aut quisquam omnis est tempore repellendus, esse exercitationem vero! Autem, a reprehenderit? Ducimus.</p>
            <hr class="my-4">
            <p class="h5">Tokat sarması hakkında daha fazla bilgi edinmek için <a href="recipe.php"><button class="btn btn-outline-success btn-sm">Tıklayınız</button></a><button class="likebtn" id="likebtn1">
                    <i class="fa fa-thumbs-up"></i>
                </button>
                <button class="dislikebtn" id="dislikebtn1">
                    <i class="fa fa-thumbs-down"></i>
                </button>
            </p>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.jumbotron -->
</div>
<script>
    let likebtn = document.querySelector('#likebtn');
    let dislikebtn = document.querySelector('#dislikebtn');
    let input1 = document.querySelector('#input1');
    let input2 = document.querySelector('#input2');




    likebtn.addEventListener('click', () => {
        likebtn.style.color = "#12ff00";
        dislikebtn.style.color = "#fff";
    })

    dislikebtn.addEventListener('click', () => {
        dislikebtn.style.color = "#ff0000";
        likebtn.style.color = "#fff";
    });


    likebtn1.addEventListener('click', () => {
        likebtn1.style.color = "#12ff00";
        dislikebtn1.style.color = "#fff";
    })

    dislikebtn1.addEventListener('click', () => {
        dislikebtn1.style.color = "#ff0000";
        likebtn1.style.color = "#fff";
    })
</script>

<body>

</html>


<?php include 'footer.php' ?>