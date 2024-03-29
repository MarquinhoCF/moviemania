<?php

    require_once("models/User.php");

    $user = new User();
    $userFullname = $user->getFullName($review->user);

    if ($review->user->image == "") {
        $review->user->image = "user.png";
    }
?>
<div class="col-md-12 review">
    <div class="row">
        <div class="col-md-1">
            <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>">
                <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $review->user->image ?>')"></div>
            </a>
        </div>
        <div class="col-md-9 author-details-container">
            <h4 class="author-name">
                <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>"><?= $userFullname ?></a>
            </h4>
            <p><i class="fa fa-star"></i> <?= $review->rating ?></p>
        </div>
        <div class="col-md-12">
            <p class="comment-title">Comentário:</p>
            <p><?= $review->review ?></p>
        </div>
    </div>
</div>