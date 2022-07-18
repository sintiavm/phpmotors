<?php
    //creta a funtion that return the reviews for a specific vehicle
    function getReviews($invId) {
        $db = phpmotorsConnect();
        $sql = "SELECT * FROM reviews WHERE invId = $invId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviews;
    }

    //create a funtion that add a review to the database
    function addReview($invId, $reviewContent) {
        $db = phpmotorsConnect();
        $sql = "INSERT INTO reviews (invId, reviewContent) VALUES (:invId, :reviewContent)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->bindValue(':reviewContent', $reviewContent, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
?>