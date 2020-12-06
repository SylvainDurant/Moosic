<?php
include('./database/functions.php');
session_start(); // Start a session

$songs = fetchAllSongs($conn);
$musicCarousel = fetchLast4Songs($conn);
// var_dump($musicCarousel); 
?>

<!-- HTML content -->
<?php include('./layouts/master.php'); ?>
<?php include('./layouts/header.php'); ?>
<?php include('./layouts/notifications.php'); ?>

<section id="content" class="bg-dark p-5">
    <h3>The movies</h3>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        
        <div class="carousel-inner">
            <?php foreach($musicCarousel as $key => $song){ ?>
                <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                    <iframe class="embed-responsive-item w-100 " style="max-height:500px"
                        src= "<?php echo $song['source'] ?>" ></iframe>
                </div>
            <?php  } ?>
        </div>
        
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<?php include('layouts/footer.php'); ?>
<!-- end HTML content -->