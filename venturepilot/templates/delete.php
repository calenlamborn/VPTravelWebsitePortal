<?php $this->layout('master', ['title' => 'Delete']) ?>

<div class="delete-warning-overlay position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" style="display: none;">
    <div class="delete-warning-box bg-dark-grey text-white p-4 rounded">
        <h4 class="text-center mb-4">Are you sure you want to delete this itinerary?</h4>
        <div class="delete-warning-buttons d-flex justify-content-center">
            <form action="<?= $this->url('delete', ['id' => $id]) ?>" method="post">
                <button type="submit" class="btn btn-danger me-2" id="delete-itinerary">Yes, delete this itinerary</button>
            </form>
            <button type="button" class="btn btn-secondary" id="cancel-delete">No, keep this itinerary</button>
        </div>
    </div>
</div>

<script>
    function showDeleteWarning() {
        var overlay = document.querySelector('.delete-warning-overlay');
        overlay.style.display = 'flex';
    }

    function hideDeleteWarning() {
        var overlay = document.querySelector('.delete-warning-overlay');
        overlay.style.display = 'none';
    }
</script>


<style>
    .delete-warning-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black;
    }

    .delete-warning-box {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .delete-warning-buttons button {
        margin: 0 10px;
    }
</style>
