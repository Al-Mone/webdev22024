<?php
// Modules
require 'includes/homepage_data.php';
require 'partials/header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 posts">
            <div class="new-post-container mb-4">
                <form method="POST" action="create_post.php">
                    <textarea class="form-control" name="post_body" rows="3"
                        placeholder="What's on your mind?"></textarea>
                    <button type="submit" class="btn btn-dark mt-2">Post</button>
                </form>
            </div>
            <?php foreach ($posts as $post): ?>
                <div class="post mb-3">
                    <div class="post-header d-flex align-items-center">
                        <img src="<?php echo htmlspecialchars(!empty($post['profile_photo']) ? $post['profile_photo'] : '../media/default-profile.jpg'); ?>"
                            alt="Profile">
                        <h5 class="ml-2"><?php echo htmlspecialchars($post['username']); ?></h5>
                        <button class="btn btn-link ml-auto"><i class="fas fa-ellipsis-v" style="color: #000;"></i></button>
                    </div>
                    <div class="post-body">
                        <h6><?php echo htmlspecialchars($post['title']); ?></h6>
                        <p><?php echo htmlspecialchars($post['body']); ?></p>
                    </div>
                    <div class="post-footer d-flex justify-content-between">
                        <button class="btn btn-light"><i class="far fa-thumbs-up"></i></button>
                        <button class="btn btn-light"><i class="far fa-comment"></i></button>
                        <button class="btn btn-light ml-auto"><i class="far fa-share-square"></i></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-4 recommended-users">
            <h5>Recommended Users</h5>
            <?php foreach ($recommended_users as $recommended_user): ?>
                <div class="recommended-user mb-3">
                    <div class="recommended-user-header d-flex align-items-center">
                        <img src="<?php echo htmlspecialchars(!empty($recommended_user['profile_photo']) ? $recommended_user['profile_photo'] : '../media/default-profile.jpg'); ?>"
                            alt="Profile">
                        <h6 class="ml-2"><?php echo htmlspecialchars($recommended_user['username']); ?></h6>
                    </div>
                    <div class="recommended-user-footer d-flex justify-content-between">
                        <button class="btn btn-light">Follow</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?>