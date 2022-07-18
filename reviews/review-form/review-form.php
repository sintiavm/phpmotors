
<form class="form-wrapper" action="/phpmotors/reviews/" method="post">
    <h2>Add a New Review</h2>
    <fieldset class="form">
        <label>car identifier:</label>
        <input type="text" name="invId" value="<?php echo $invId; ?>" readonly>

        <label>Review: </label>
        <textarea name="review" id="review" cols="30" rows="10" required></textarea>
    </fieldset>
    <input type="submit" name="submit" value="Add-Review">
    <input type="hidden" name="action" value="add-review">
</form>