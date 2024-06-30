<!-- Homepage Design ---------------------------------------------------------------->

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
                    <div class="d-flex">
                        <img src="<?php echo htmlspecialchars($current_user['profile_photo']); ?>" alt="Profile"
                            class="profile-pic-iconified mr-2">
                        <textarea class="form-control" name="post_body" rows="3"
                            placeholder="What's on your mind?"></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button type="submit" class="btn btn-dark">Post</button>
                    </div>
                </form>
            </div>
            <?php foreach ($posts as $post): ?>
                <div class="post mb-3">
                    <div class="post-header d-flex align-items-center">
                        <a href="user.php?userId=<?php echo htmlspecialchars($post['userId']); ?>">
                            <img src="<?php echo htmlspecialchars(!empty($post['profile_photo']) ? $post['profile_photo'] : '../media/default-profile.jpg'); ?>"
                                alt="Profile">
                        </a>
                        <a href="user.php?userId=<?php echo htmlspecialchars($post['userId']); ?>"
                            class="ml-2"><?php echo htmlspecialchars($post['username']); ?></a>
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
        <div class="col-md-4">
            <?php include 'includes/recommended_users.php'; ?>
        </div>
    </div>
</div>

<?php
require 'partials/footer.php';
?>