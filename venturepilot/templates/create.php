<?php $this->layout('master', ['title' => 'Create']) ?>

<main class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <h2>Create Trip</h2>
            <p>Add Pictures</p>
            <div class="add-picture-container">
                <label for="pictures" class="add-picture-label">
                    <i class="fas fa-plus"></i>
                    <input type="file" id="pictures" name="pictures[]" multiple style="display: none;">
                </label>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                    <label for="images">Images:</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" multiple accept="image/*">
                </div>
            <form action="/venturepilot/create" method="post" enctype="multipart/form-data"> <!-- Form starts here -->
                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="6" style="resize: none; width: 90%;"></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="attractions">Attractions:</label>
                    <textarea class="form-control" id="attractions" name="attractions" rows="4" style="resize: none; width: 90%;"></textarea>
                </div>
        </div>
        <div class="col-md-6">
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="trip-name">Trip Name:</label>
                    <input type="text" class="form-control" id="trip-name" name="trip-name" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="season">Season:</label>
                    <input type="text" class="form-control" id="season" name="season" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="duration">Duration:</label>
                    <input type="text" class="form-control" id="duration" name="duration" required>
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="price-range">Price Range:</label>
                    <input type="text" class="form-control" id="price-range" name="price-range" required>
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Save</button>
            </form>
        </div>
    </div>
</main>

<style>
    .add-picture-container {
        position: relative;
        width: 200px;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .add-picture-label {
        cursor: pointer;
    }

    .add-picture-label i {
        font-size: 36px;
        color: #ccc;
    }
</style>
