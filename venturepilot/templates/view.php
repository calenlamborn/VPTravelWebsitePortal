<?php $this->layout('master', ['title' => 'View']) ?>

<!-- Check to see if a user is logged in or not, and get their ID -->
<?php $loggedIn = isset($_SESSION['user_id']); 
$userId = $loggedIn ? $_SESSION['user_id'] : null; ?>

<main class="container mt-4">
    <div class="row">
        <?php if (!empty($itinerary) && is_array($itinerary)) : ?>
            <?php foreach ($itinerary as $item) : ?>
                <?php if ($item['ItineraryID'] == $id) : ?>
                    <div class="col-md-6">
                        <!-- Rounded Image Carousel -->
                        <div id="carouselExampleControls" class="carousel slide rounded" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php if (is_array($item['Images'])) : ?>
                                    <?php foreach ($item['Images'] as $key => $image) : ?>
                                        <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                                            <img src="/venturepilot/images/<?= $image ?>" class="d-block w-100 rounded" alt="Image <?= $key + 1 ?>">
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="carousel-item active">
                                        <img src="/venturepilot/images/<?= $item['Images'] ?>" class="d-block w-100 rounded" alt="Single Image">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Rounded Box for Text -->
                        <div class="rounded bg-dark-grey p-3 position-relative">

                            <!-- Edit Button -->
                            <?php if ($loggedIn && $userId == $item['UserID']) : ?>
                                <a href="<?= $this->url('update', ['id' => $item['ItineraryID']]) ?>" class="text-decoration-none text-gray position-absolute top-0 end-0 p-3">[Edit]</a>
                            <?php endif; ?>

                            <h2><?= isset($item['Location']) ? $item['Location'] : 'Location Unknown' ?></h2>
                            <p>Season: <?= isset($item['Season']) ? $item['Season'] : 'Season Unknown' ?></p>
                            <p>Duration: <?= isset($item['Duration']) ? $item['Duration'] : 'Duration Unknown' ?></p>
                            <p>Description: <?= isset($item['Description']) ? $item['Description'] : 'Description Unavailable' ?></p>
                            <p>Attractions: <?= isset($item['Attractions']) ? $item['Attractions'] : 'Attractions Unavailable' ?></p>
                            <p>Price Range: <?= isset($item['PriceRange']) ? $item['PriceRange'] : 'Price Range Unknown' ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No itinerary details available.</p>
        <?php endif; ?>
    </div>
</main>

<style>
.bg-dark-grey {
    background-color: #222;
}
.text-gray {
    color: #888;
}
</style>
