<?php
    require_once '../library/connections.php';
    require_once '../model/main-model.php';
    require_once '../model/vehicles-model.php';
    require_once '../model/uploads-model.php';
    require_once '../library/functions.php';
    require_once '../model/review-model.php';

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $id = $invId;



    switch($action) {
        case 'add-review':
            $reviewContent = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);

            if (empty($reviewContent)) {
                $message = '<p class="notice">Please provide a review.</p>';
            } else {
                $message = addReview($invId, $reviewContent);
                $message = "<p class='notice'>$message</p>";
            }

            header ("Location: /phpmotors/vehicles?action=details&invId=$invId");
        break;
        default:
            include '../view/reviews-section.php';
            
            $review = getReviews($id);
            if (!$review) {
                echo "<p class='notice'>No reviews have been added.<br><b>Be the first to post one</b></p>";
            } else {
                $reviews = displayReviews($review);
                echo $reviews;
            }

            require_once $_SERVER['DOCUMENT_ROOT'] . './phpmotors/templates/footer.php'; 
            exit;
        break;
    }
?>