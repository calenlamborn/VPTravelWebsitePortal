<?php $this->layout('master', ['title' => 'My Trips']) ?>

<!-- Check to see if a user is logged in or not -->
<?php $loggedIn = isset($_SESSION['user_id']); ?>

<main>
    <section class="featured-destinations">
        <div class="container">
            <h4 class="text-left">My Trips</h4>
            <p class="text-left">Your featured list of destinations</p>

            <?php if ($loggedIn) : ?>
                <div class="row mt-5">
                    <?php foreach ($itinerary as $key => $item) : ?>
                        <?php if ($key < 2) : ?>
                            <div class="col-md-6 mb-4" onclick="window.location.href='<?= $this->url('view', ['id' => $item['ItineraryID']]) ?>'">
                                <div class="rounded-box">
                                    <div class="gradient-overlay"></div>
                                    <h4 class="title-text"><?= isset($item['Location']) ? $item['Location'] : 'Location Unknown' ?></h4>
                                    <p class="attractions-text"><?= isset($item['Attractions']) ? $item['Attractions'] : 'Attractions Unknown' ?></p>
                                    <img src="/venturepilot/images/<?= isset($item['Images']) ? $item['Images'] : 'placeholder.jpg' ?>" class="img-fluid" alt="Trip Image">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>Please <a href="<?= $this->url('signup') ?>">create an account</a> to create trips.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
    body, html {
        margin: 0;
        padding: 0;
    }

    .featured-destinations {
        background-color: rgba(0, 0, 0, 0.1);
        padding: 50px 0;
    }

    .rounded-box {
        position: relative;
        height: 200px;
        border-radius: 20px;
        background-color: #ddd;
        overflow: hidden;
        transition: transform 0.4s ease;
    }
    .rounded-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .rounded-box:hover {
        transform: scale(1.03);
    }

    /* Gradient overlay from top */
    .rounded-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 30%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.8), rgba(0,0,0,0.01));
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    /* Gradient overlay from bottom */
    .rounded-box::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30%;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.01));
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .title-text {
        position: absolute;
        top: 10px;
        right: 20px;
        color: #fff;
        font-size: 1rem;
    }

    .attractions-text {
        position: absolute;
        bottom: 2px;
        left: 20px;
        color: #f0f0f0;
        font-size: 0.8rem;
        z-index: 99;
    }
</style>
