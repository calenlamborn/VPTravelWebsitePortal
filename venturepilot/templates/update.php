<?php $this->layout('master', ['title' => 'Update']) ?>

<main class="container mt-5 mb-5">
    <div class="row">
        <?php if (!empty($itinerary) && is_array($itinerary)) : ?>
            <?php foreach ($itinerary as $item) : ?>
                <?php if ($item['ItineraryID'] == $id) : ?>
                    <div class="col-md-6">
                        <!-- Slideshow for images -->
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $images = explode(',', $item['Images']); ?>
                                <?php foreach ($images as $index => $image) : ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                        <img src="/venturepilot/images/<?= $image ?>" class="d-block w-100 rounded" alt="Image <?= $index + 1 ?>">
                                    </div>
                                <?php endforeach; ?>
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

                        <!-- Buttons for adding and deleting images -->
                        <form action="/add-image" method="post" enctype="multipart/form-data">
                            <div class="form-group mt-4">
                                <input type="file" id="add-image" name="add-image[]" multiple style="display: none;">
                                <label for="add-image" class="btn btn-secondary mt-2">Add Image</label>
                                <button type="button" class="btn btn-danger mt-2" onclick="showDeleteWarning()">Delete Image</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <!-- Update Trip Form -->
                        <h2>Update Trip</h2>
                        <form action="<?= $this->url('update', ['id' => $id]) ?>" method="post">
                            <div class="form-group">
                                <label for="location">Location:</label>
                                <input type="text" class="form-control" id="location" name="location" value="<?= isset($item['Location']) ? $this->e($item['Location']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="season">Season:</label>
                                <input type="text" class="form-control" id="season" name="season" value="<?= isset($item['Season']) ? $this->e($item['Season']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration:</label>
                                <input type="text" class="form-control" id="duration" name="duration" value="<?= isset($item['Duration']) ? $this->e($item['Duration']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="price-range">Price Range:</label>
                                <input type="text" class="form-control" id="price-range" name="price-range" value="<?= isset($item['PriceRange']) ? $this->e($item['PriceRange']) : '' ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="attractions">Attractions:</label>
                                <textarea class="form-control" id="attractions" name="attractions" rows="4" style="resize: none;" required><?= isset($item['Attractions']) ? $this->e($item['Attractions']) : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="6" style="resize: none;" required><?= isset($item['Description']) ? $this->e($item['Description']) : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="images">Images:</label>
                                <input type="text" class="form-control" id="images" name="images" value="<?= isset($item['Images']) ? $this->e($item['Images']) : '' ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <!-- Delete button to navigate to the delete page -->
                            <a href="<?= $this->url('delete', ['id' => $id]) ?>" class="btn btn-danger">Delete Trip</a>
                        </form>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No itinerary details available.</p>
        <?php endif; ?>
    </div>
</main>